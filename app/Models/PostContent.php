<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostContent extends Model
{
    //

	protected $table = 'post_contents';
	
    public function post()
    {
    	 return $this->belongsTo('App\Models\Post');
    }



    public function insertDataPostContent($data)
    {
        $insert = DB::table('post_contents')->insert($data);
      	if($insert){
      		return true;
      	}
      	return false;
    }

    public function updateDataContentPostById($data,$id)
    {
      $up = DB::table('post_contents')
          ->where('post_id',$id)
          ->update($data);
          
      return $up;
    }
}
