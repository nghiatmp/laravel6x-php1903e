<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Model\Tag;
class Post extends Model
{
    protected $table = 'posts';

    // tao 1 ham dinh nghia mqh voi category
    public function categories(){
    	 return $this->belongsTo('App\Model\Category');
    }

    public function post_tag()
    {
    	return $this->hasMany('App\Model\PostTag');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Model\Tag');
    }


    public function insertDataPost($data)
    {
        DB::table('posts')->insert($data);
        //lay ra id vua insert
        $id = DB::getPdo()->lastInsertId();
        return $id;
    }

    public function getAllDataPost($keyword = ''){
        $data = DB::table('posts as p')
                    ->select('p.*','c.name_cate','a.fullname')
                    ->join('categories as c','p.cate_id','=','c.id')
                    ->join('admins as a','p.user_id','=','a.id')
                    ->where('p.title','like','%'.$keyword.'%')
                    ->orwhere('p.sapo','like','%'.$keyword.'%')
                    ->paginate(5);
        return $data;
    }

    public function deletePostById($id)
    {
        $del = DB::table('posts')
                ->where('id',$id)
                ->delete();
        return $del;
    }

    public function getInforDataPostById($id)
    {
      
        $data = DB::table('posts as p')
                ->select('p.*','pc.content_web')
                ->join('post_contents as pc','pc.post_id','=','p.id')
                ->where('p.id',$id)
                ->first();
        $data = json_decode(json_encode($data),true);


        return $data;
    }

    public function updateDataPostById($data,$id)
    {
        $up = DB::table('posts')
            ->where('id',$id)
            ->update($data);

        return $up;
    }


    ///////////////////////// FOR FRONTED ////////////////////////////////////////

    public function getListPostByPublishDate()
    {
        $today = date('Y-m-d H:i:s');
        $data = DB::table('posts as a')
                ->join('categories as b','a.cate_id','=','b.id')
                ->join('admins as c','a.user_id','=','c.id')
                ->select('a.*','b.name_cate','b.parent_id','c.fullname')
                ->where('a.publish_date','<=',$today)
                ->where('a.status',1)
                ->orderBy('a.publish_date','desc')
                ->paginate(11);
        return $data;
    }

    //lay ra 3 bai viet co luot xwm cao nhat

    public function popularPost()
    {
         $today = date('Y-m-d H:i:s');
        $data = DB::table('posts as a')
                ->select('a.*')
                ->where('a.publish_date','<=',$today)
                ->where('a.status',1)
                ->orderBy('a.count_view','desc')
                ->take(3)
                ->get();
        return $data;
    }

    public function getCateByPost(){
        $data = DB::table('posts as p')
            ->select(DB::raw('Count(*) as sl'),'c.name_cate','c.id')
            ->join('categories as c','p.cate_id','=','c.id')
            ->orderBy('sl','desc')
            ->groupBy('c.id')
            ->get();
        return $data;
    }


    public function getTangByPost()
    {
        $data = DB::table('posts as p')
                ->join('post_tag as pt','p.id','=','pt.post_id')
                ->join('tags as t','pt.tag_id','=','t.id')
                ->select('t.name_tags','t.id')
                ->groupBy('t.id')
               ->get();
        return $data;
    }

    public function getDataPostBySlug($slug)
    {
        $today = date('Y-m-d H:i:s');
        $data =  DB::table('posts as p')
                ->select('p.*','pc.content_web','a.fullname','c.name_cate')
                ->join('post_contents as pc','pc.post_id','=','p.id')
                ->join('categories as c','c.id','=','p.cate_id')
                ->join('admins as a','a.id','=','p.user_id')
                ->where('p.publish_date','<=',$today)
                ->where('p.status',1)
                ->where('p.slug',$slug)
                ->first();
        return $data;
    }

    public function getDataPostByID($cate,$idpost)
    {
        $today = date('Y-m-d H:i:s');
        $data =  DB::table('posts as p')
                ->select('p.*','a.fullname','c.name_cate')
                ->join('categories as c','c.id','=','p.cate_id')
                ->join('admins as a','a.id','=','p.user_id')
                ->where('p.publish_date','<=',$today)
                ->where('p.status',1)
                ->where('p.cate_id',$cate)
                ->where('p.id','<>',$idpost)
                ->take(3)
                ->get();
        $data =json_decode(json_encode($data),true);
        return $data;
    }
    public function updateView($id,$view)
    {
        $count = $view + 1;
        $up = DB::table('posts as p')
                ->where('p.id',$id)
                ->update([ 'p.count_view'=>$count ]);
        return $up;
    }

    public function searchDataPostByKey($keyword)
    {
        $today = date('Y-m-d H:i:s');
        $data =  DB::table('posts as p')
                ->select('p.*','a.fullname','c.name_cate')
                ->join('categories as c','c.id','=','p.cate_id')
                ->join('admins as a','a.id','=','p.user_id')
                ->where('p.publish_date','<=',$today)
                ->where('p.status',1)
                // ->where('p.title','LIKE',$keyword)
                // ->where('p.sapo','LIKE',$keyword)
                // ->where('p.slug','LIKE',$keyword)
                ->where(function($query) use ($keyword){
                    $query->where('p.title','LIKE','%'.$keyword.'%')
                        ->orwhere('p.sapo','LIKE','%'.$keyword.'%')
                        ->orwhere('p.slug','LIKE','%'.$keyword.'%');
                })  
                ->orderBy('p.publish_date','desc')
                ->paginate(8);
        // $data =json_decode(json_encode($data),true);
        return $data;
    }       

}
