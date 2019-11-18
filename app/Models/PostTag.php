<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
	protected $table = 'post_tag';

    public function posts()
    {
    	return $this->belongsTo('App\Model\Post');
    }
    public function tags()
    {
    	return $this->belongsTo('App\Model\Tag');
    }
    public function post_contents()
    {
    	 return $this->hasOne('App\Model\PostContent');
    }
}
