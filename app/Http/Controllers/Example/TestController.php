<?php

namespace App\Http\Controllers\Example;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
	public function __construct()
    {
    	// goi middleware
    	// tat ca phuong thuc nam trong controller se bi middleware chi phoi
       	 // $this->middleware('check.user');

    	// 	Chi muon middleware tac dong vao 1 hay nhieu action nao do

        // $this->middleware('check.user')->only(['index','viewData']);


    	// Loai tru
        // $this->middleware('subscribed')->except('demoData');
    }
    public function index(){
    	return " PASSS this is ".__CLASS__;
    }
    public function viewData(){
    	return " PASSS this is ".__FUNCTION__;
    }
    public function demoData(){
    	return " PASSS this is ".__FUNCTION__;
    }
}
