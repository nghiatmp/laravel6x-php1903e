<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Tag extends Model
{
    protected $table = 'tags';

    public function post_tag()
    {
    	return $this->hasMany('App\Model\PostTag');
    }

    public function posts()
    {
    	return $this->belongsToMany('App\Model\Post');
    }


    public function getAllDataTag()
    {
    	$data = [];
    	$tag = Tag::all();
    	if($tag){
    		$data = $tag->toArray();
    	}
    	return $data;
    }

    public function getDataTagByPost()
    {
        $data = DB::table('tags as t')->select('t.*','pt.post_id')
                ->join('post_tag as pt','t.id','=','pt.tag_id')
                ->get();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

    public function getDataByPost($id){
        $data = DB::table('tags as t')
                ->select('t.*','pt.post_id')
                ->join('post_tag as pt','t.id','=','pt.tag_id')
                ->where('pt.post_id',$id)
                ->get();
        $data = json_decode(json_encode($data),true);
        return $data;
    }

     public function getPostByTag($id)
    {
        $today = date('Y-m-d H:i:s');
        $data = DB::table('tags as t')->select('t.id as idtag','p.*','c.name_cate','a.fullname')
                ->join('post_tag as pt','t.id','=','pt.tag_id')
                ->join('posts as p','pt.post_id','=','p.id')
                ->join('categories as c','c.id','=','p.cate_id')
                ->join('admins as a','a.id','=','p.user_id')
                ->where('t.id',$id)
                ->where('p.publish_date','<=',$today)
                ->where('p.status',1)
                ->paginate(2);
        
        return $data;
    }

}
