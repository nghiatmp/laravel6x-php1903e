<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Tag;

class TagController extends FrontendController
{
    public function listTag(Tag $tag,$slug,$id)
    {
    	$listPost = $tag->getPostByTag($id);
    	$data['paginate'] = $listPost;
    	
    	$listPost = json_decode(json_encode($listPost),true);
    	
    	$data['mainCate'] = $listPost['data'] ?? [];
    	// dd($data['listPost']);
    	return view('frontend.tag.list',$data);
    	
    }
}
