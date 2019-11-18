<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostContent;
use App\Models\Tag;
use App\Http\Requests\StoreBlogPost;
use App\Http\Requests\UpdateBlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request, Post $post,Tag $tag)
    {
        // $dataPost= DB::table('posts')->get();
        $data['createPostSuccess'] =$request->session()->get('createPostSuccess');

        $keyword =$request->keyword;
        $keyword= strip_tags($keyword);
        $data['keyword'] = $keyword;

        $listPost = $post->getAllDataPost($keyword);
        $data['paginate'] =$listPost;
        $listPost = json_decode(json_encode($listPost),true);

        $listPost = $listPost['data'] ?? [];
        

        $listTag  = $tag->getDataTagByPost();

        // gan tags vao bai viet
        foreach ($listPost as $key => $val) {
            $listPost[$key]['listTags'] = [];
            foreach ($listTag as $k => $item) {
                if($val['id'] == $item['post_id']){
                     $listPost[$key]['listTags'][] = $item['name_tags'];
                }
            }
        }

        // dd($listPost);
        $data['listPost'] = $listPost;
        // dd($listPost);
        $data['UpdatePostSuccess'] =   $request->session()->get('UpdatePostSuccess');



    	return view('admin.post.index',$data);

    }
    public function createpost(Category $cate,Tag $tag,Request $request){
    	$data = [];
    	$data['cates'] = $cate->getAllDataCategories();
    	$data['tags'] = $tag->getAllDataTag();
        $data['errorPublishDate'] =    $request->session()->get('errorPublishDate');
        $data['ErrorAvatar'] =    $request->session()->get('ErrorAvatar');



        return view('admin.post.create',$data);
    }
    public function handleCreatePost(StoreBlogPost $request,Post $posts, PostContent $postContent)
    {
    	// dd($request->all());
        $title         = $request->titlePost;
        $slug          = Str::slug($title,'-');
        $sapo          = $request->sapoPost;
        $contentPost   = $request->contentPost;
        $languagePost  = $request->languagePost;
        $category      = $request->catePost;
        $tags          = $request->tagPost;

        // publishDate
        $publishDate = $request->publishDate;
        //kiem tra publishDate
        if($publishDate){
            // kiem tra no phai nho hon thoi gian hien tai
                $today = date('Y-m-d H:i:s');
                $timePublishDate = strtotime($publishDate);
                $timeToDay = strtotime($today);

                if($timePublishDate < $timeToDay){
                    // sai bao loi chon lai
                    $request->session()->flash('errorPublishDate','Ngày xuất bản không nhỏ hơn ngày hiện tại');
                    return redirect()->back();
                }
                $publishDate = date('Y-m-d H:i:s',strtotime($publishDate));
        }

        // if(isset($_FILES['avatar'])){
        //     $fileName = $_FILES['avatar']['name'];
        //     $tmpName = $_FILES['avatar']['tmp_name'];

        //     $up = move_uploaded_file($tmpName,public_path().'/upload/image'.$fileName);
        // }

        // upload file laravel
        // if ($request->hasFile('avatar')) {
        //     //iem tra xem dung co chon file hay khong
        //     //kiem tra xem file co loi khong
        //     if ($request->file('avatar')->isValid()) {
        //         //lay thong tin file
        //         $file = $request->file('avatar');
        //         // dd($file);
        //         // lay ten file
        //         $nameFile = $file->getClientOriginalName();
        //         // upload file
        //         $up = $file->move(public_path('upload/image/'), $nameFile);
        //         if(!$up){
        //              $request->session()->flash('ErrorAvatar','Không Upload ảnh lên server');
        //              return redirect()->back();
        //         }
            // }
        // }
         // if($request->hasFile('avatar')){
            $nameFile = time().'.'.$request->avatar->extension();  
           
        // }


        // $nameFile = time().'.'.$request->avatar->extension();  
        // $request->avatar->move(public_path('upload/image/'), $nameFile);

        // insert data to post table
        $dataInsert = [
            'title'         =>  $title ,
            'slug'          =>  $slug ,
            'sapo'          =>  $sapo ,
            'cate_id'       =>  $category ,
            'avatar'        =>  $nameFile,
            'publish_date'  =>  $publishDate ,
            'user_id'       =>  $request->session()->get('idSession'),
            'lang_id'       => $languagePost ,
            'count_view'    =>  0 ,
            'status'        => 1,
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    => null,
        ];

        $idPost = $posts->insertDataPost($dataInsert);
        $request->avatar->move(public_path('upload/image/'),$nameFile);
        
        if($idPost > 0){
            // insert data to post content
            $postContentPost = [
                'post_id'      => $idPost,
                'content_web'  => $contentPost,
                'content_mobile' =>null,
                'created_at'    =>  date('Y-m-d H:i:s'),
                'updated_at'    => null,
            ];

            $contentInsert = $postContent->insertDataPostContent($postContentPost);

            // insert post tag

            if($contentInsert){
                if(!empty($tags)){
                    foreach ($tags as $key => $idTag) {
                        DB::table('post_tag')->insert([
                            'post_id' => $idPost,
                            'tag_id'  =>  $idTag,
                            'created_at'    =>  date('Y-m-d H:i:s'),
                            'updated_at'    => null,
                        ]);
                    }
                }

             $request->session()->flash('createPostSuccess','Tạo Bài Viết Thành Công ');
             return redirect()->route('admin.post');

            }else{
                $request->session()->flash('errorPostContent','Tạo Post Content ');
                return redirect()->back();
            }

        }else{
            $request->session()->flash('errorPost','Tạo Bài Viết Lỗi');
            return redirect()->back();
        }

    }

    public function deletePost(Request $request,Post $post)
    {
        $id = $request->id;
        $id = is_numeric($id) ? $id : 0;

        if($id>0){
            $del = $post->deletePostById($id);
            if($del){
                echo "ok";
            }else{
                echo "fail";
            }
        }else{
            echo "err";
        }
    }

    public function edit($slug,$id, Post $post,Category $cate,Tag $tag)
    {
        // dd($slug,$id);
        $id = is_numeric($id) ? $id : 0;
        $inforPost =$post->getInforDataPostById($id);
        // dd($inforPost);


        // dd($arrIdTag);
        if($inforPost){
            $data = [];
            $data['cates'] = $cate->getAllDataCategories();
            $data['tags'] = $tag->getAllDataTag();
            $data['info'] = $inforPost;

                $listTag  = $tag->getDataTagByPost();
                 $arrIdTag =[];
                
                foreach ($listTag as $key => $item) {
                    if($item['post_id'] ==$id){
                        $arrIdTag[] = $item['id'];
                    }
                }

                $data['arrIdTag'] = $arrIdTag;

            return view('admin.post.edit',$data);

        }else{
            abort(404);
        }
    }


    public function handleUpdatePost(UpdateBlogPost $request,Post $posts, PostContent $postContent,Tag $tag)
    {
        // dd($request->all());
        $title         = $request->titlePost;
        $slug          = Str::slug($title,'-');
        $sapo          = $request->sapoPost;
        $contentPost   = $request->contentPost;
        $languagePost  = $request->languagePost;
        $category      = $request->catePost;
        $tags          = $request->tagPost;
        $status        = $request->status;
        $status = in_array($status,['0','1']) ? $status : 0;

        $idPost = $request->id;
        $idPost = is_numeric($idPost) ? $idPost : 0 ;
        $inforPost =$posts->getInforDataPostById($idPost);

        $oldPublishDate = $inforPost['publish_date'];

         // publishDate
        $publishDate = $request->publishDate;

        //kiem tra publishDate
        if($publishDate){
            // kiem tra no phai nho hon thoi gian hien tai
            //so sanh publish nguoi dung gui len voi oldpushlish date
            //neu n giong nhau thu khong xuat ban
            //nguoc lai moi kiem tra

            $timeOldPushlishDate = strtotime($oldPublishDate);            
            $today = date('Y-m-d H:i:s');
            $timePublishDate = strtotime($publishDate);
            $timeToDay = strtotime($today);
            if( $timePublishDate !=$timeOldPushlishDate ){
                if($timePublishDate < $timeToDay){
                    // sai bao loi chon lai
                    $request->session()->flash('errorPublishDate','Ngày xuất bản không nhỏ hơn ngày hiện tại');
                    return redirect()->back();
                }else{
                    $oldPublishDate = $publishDate;
                }
            }
                
        
        }
        // validate title:khong dc update title da ton tai ngoai tru title dang xem

        // $validator = Validator::make(
        //     ['titlePost'=>'title'],
        //     [
        //        'titlePost'=>'unique:posts,title,'.$idPost
        //     ],
        //     [
        //         'unique' => 'Tiêu Đề Đã Tồn Tại'
        //     ]
        // );
          // if($validator->fails()){
          //   return redirect()->route('admin.editPost',['slug'=>$slug ,'id'=>$idPost])
          //   ->withErrors($validator)
          //   ->withInput();
          //   }else{
          //   // dd('ok');
          //   }

       
            $this->validate($request,
            [
                'titlePost'=>'unique:posts,title,'.$idPost,
            ],
            [
                'titlePost.unique' => 'Tiêu Đề Đã Tồn Tại',
            ]
        );
       
        
        $oldAvartar = $inforPost['avatar'];
        if($request->hasFile('avatar')){
            //co thay anh
            if($request->file('avatar')->isValid()){
                    $this->validate($request,
                    [
                       'avatar'  => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ],
                    [
                        'avatar.required' => 'Vui Long Chon Anh',
                        'avatar.mimes'    => 'Anh Không Đúng Định Dạng ',
                    ]
                );
            }
            $oldAvartar = time().'.'.$request->avatar->extension();
            // $request->avatar->move(public_path('upload/image/'),$oldAvartar);
        }

        
      // cac buoc update du lieu
        $dataUpdate = [
            'title' => $title,
            'slug'  => $slug,
            'sapo'  => $sapo,
            'cate_id'  => $category,
            'publish_date' =>date('Y-m-d H:i:s',strtotime($oldPublishDate)),
            'avatar'   => $oldAvartar,
            'lang_id'  => $languagePost,
            'status'   => $status,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $update = $posts->updateDataPostById($dataUpdate,$idPost);
         if($request->hasFile('avatar')){
             $request->avatar->move(public_path('upload/image/'),$oldAvartar);
        }

        if($update){
            //tiep tuc
            $updateContent = [
                'content_web' => $contentPost
                ];

                $upV2 =$postContent->updateDataContentPostById($updateContent,$idPost);
               
                //xoa het du lieu sau do inset lai
                //chi huc hien khi nguoi dung thuc su chon lai tag
                 $listTag  = $tag->getDataTagByPost();
                 $arrIdTag = [];
                
                    foreach ($listTag as $key => $item) {
                        if($item['post_id'] ==$idPost){
                            $arrIdTag[] = $item['id'];
                        }
                    }   

                    // check $arrId neu khac nhau thi moi update
                $flashCheck = false;
                foreach ($arrIdTag as $i) {
                    foreach ($tags as $j) {
                        if($i != $j){
                            $flashCheck =true;
                            break;
                        }
                    }
                }
                if($flashCheck){
                    $del = DB::table('post_tag')
                        ->where('post_id',$idPost)
                        ->delete();
                    if(!empty($tags) && $del){
                        foreach ($tags as $key => $idTag) {
                            DB::table('post_tag')->insert([
                                'post_id' => $idPost,
                                'tag_id'  =>  $idTag,
                                'created_at'    =>  date('Y-m-d H:i:s'),
                                'updated_at'    => null,
                            ]);
                        }
                    }
                }
                
             $request->session()->flash('UpdatePostSuccess','Chinh sửa  Bài Viết Thành Công');
             return redirect()->route('admin.post');

        }else{
             $request->session()->flash('errUpdatePost','Chinh sửa  Bài Viết Thành Lỗi');
             // return redirect()->route('admin.editPost');
             return redirect()->route('admin.editPost',['slug'=>$slug ,'id'=>$idPost]);
        }
        
    }

}
