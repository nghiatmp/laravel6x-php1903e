<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Post;
use App\Models\Tag;

class DetailBlogController extends FrontendController
{
    public function index($slug,Request $request,Post $post,Tag $tag)
    {
    	$inforPost = $post->getDataPostBySlug($slug);
    	$inforPost =json_decode(json_encode($inforPost),true);
    	if($inforPost){
    		//lat tag theo bai viet
    		$listTag = $tag->getDataByPost($inforPost['id']);
            //lay ra 3 bai viet cung cate voi bai viet
            $listPost = $post->getDataPostByID($inforPost['cate_id'],$inforPost['id']);
            // dd($listPost);
            $data = [];
            $data['info'] = $inforPost;
            $data['listTag'] =$listTag;
            $data['listPost'] = $listPost;

            return view('frontend.blog.detail',$data);
    	}else{
    		abort(404);
    	}
    }
    public function UpdateCountView(Request $request,Post $post)
    {
        $idPost = $request->id;
        $idPost = is_numeric($idPost) && $idPost > 0 ? $idPost:0;
        $inforPost = $post->getInforDataPostById($idPost);
        // Lay ra luot view truoc khi update- sau do update 1 don ci
        if($inforPost){
            $view = $inforPost['count_view'];
            $up = $post->updateView($idPost,$view);
             if($up){
                echo "ok";
             }else{
                echo "err";
             }
        }
       
    }
}
