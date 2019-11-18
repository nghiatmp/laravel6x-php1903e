<?php

namespace App\Http\Controllers\Example;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpController extends Controller
{
    public function index(){
    	return "this is ".__CLASS__;
    }
    public function demo($idPd,$myAge,$money,Request $request)
    {
    	$t = $request->input('id','aaa');
    	// $t = $request->query('id');
    	$all = $request->all();

    	dd($idPd,$myAge,$money,$t,$all);
    }
    public function login(){
    	return view('test_login');
    }
    public function handleLogin(Request $request){
    	// $data= $request->all();
    	// $user = $request->input('user');
    	// $pass = $request->input('password');

    	// $user = $request->user;
    	// $pass = $request->password;
    	$user = $request->query('user');
    	$pass = $request->query('password');
    	 dd($user,$pass);

    }
}
