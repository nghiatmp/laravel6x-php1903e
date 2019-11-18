<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    // tao 1 ham dinh nghia moi quan he voi bang post
    public function posts()
    {
    	return $this->hasMany('App\Models\Post');
    }

    public function getAllDataCategories()
    {
    	$data = [];
    	$cate = Category::all();
    	if($cate){
    		$data = $cate->toArray();
    	}
    	return $data;
    }
    //lay ra 5 cate co bai viet nhieu nhat
    public function  getDataCateByPost()
    {
        $data = DB::table('categories as c')
                ->select('c.*','p.id as PostID' )
                ->join('posts as p','p.cate_id','=','c.id')
                ->get();
        return $data;
    }
    public function getDataCatePani($id)
    {
        $today = date('Y-m-d H:i:s');
        $data = DB::table('posts as p')
                ->select('c.*','p.*','p.id as idpost','p.slug','a.fullname')
                ->join('categories as c','p.cate_id','=','c.id')
                ->join('admins as a','a.id','=','p.user_id')
                ->where('p.publish_date','<=',$today)
                ->where('p.cate_id',$id)
                ->where('p.status',1)
                ->paginate(8);
        return $data;
    }
}
