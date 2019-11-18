<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FrontendController;
use App\Models\Category;

class CategoryController extends FrontendController
{
    public function listCate($slug,$id,Category $cate)
    {
    	// dd($slug,$id);
    	$id = is_numeric($id) && $id > 0 ? $id :0;
    	$listCate = $cate->getDataCatePani($id);

    	if($listCate){
    		$data = [];
    		$data['paginate'] = $listCate;
    		$arrCate= json_decode(json_encode($listCate),true);
    		$mainCate = $arrCate['data'] ?? [];
    		$data['mainCate'] = $mainCate;
    		$data['slug']     =$slug;

    		return view('frontend.category.list',$data);

    	}
    }
}
