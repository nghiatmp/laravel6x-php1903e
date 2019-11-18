<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index(){
    	return "This is function  ".__FUNCTION__;
    }
    public function test(){
    	return "this is test";
    }
    
}
