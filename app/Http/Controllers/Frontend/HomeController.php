<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class HomeController extends FrontendController
{
    public function index(Post $post ){



    	$data = [];
    	$listpost= $post->getListPostByPublishDate();
    	$data['paginate'] = $listpost;

    	$mainData = json_decode(json_encode($listpost),true);

    	$postDatas = $mainData['data'] ?? [];

    	 //lay 3 bai slider
        $slider =  array_slice($postDatas,0,3);

    	//lay 8 bai lastest
        $lastest = array_slice($postDatas,4,8);
                // dd($lastest);
        $data['slider'] = $slider;
        $data['lastest'] = $lastest;


    	return view('frontend.home.index',$data);
    }
}
