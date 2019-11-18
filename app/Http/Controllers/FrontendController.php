<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Categories;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
class FrontendController extends Controller
{
    //
    public function __construct(Category $cate ,Post $post, Tag $tag,Request $request)
    {

        $listCate = $cate->getAllDataCategories();
        $treeCate = Categories::buildTreeCategory($listCate);

        $popularPost = $post->popularPost();
        $popularPost = json_decode(json_encode($popularPost),true);
        

        $dataCatePost = $post->getCateByPost();
        $dataCatePost = json_decode(json_encode($dataCatePost),true);
       
        

        $dataTag = $post->getTangByPost();
        $dataTag = json_decode(json_encode($dataTag),true);
         // dd($dataTag);
        $keyword = $request->s;
        $keyword = trim($keyword);

        //share du lieu cho tat ca cac view
        View::share('view',[
        	'treeCate' => $treeCate,
        	'listCate' => $listCate,
        	'popularPost'  => $popularPost,
        	'catePost'   => $dataCatePost,
            'tags'       => $dataTag,
            'keyword'    =>$keyword
        ]);
    }
}
