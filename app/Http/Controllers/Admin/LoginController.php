<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\AdminLoginPost as AdminRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class LoginController extends Controller
{
    public function index(Request $request)
    {
    	$data = [];
    	$data['messages'] = $request->session()->get('errorLogin');
    	//load view
    	return view('admin.login.index',$data);
    }

    public function handleLogin(AdminRequest $request, Admin $admin){
    	$email = $request->txtemail;
    	$password = $request->txtpass;

    	$inforAdmin = $admin->checkAdminLogin($email,$password);
    	// dd($inforAdmin);
    	if($inforAdmin){
    		// dang nhap thanh cong
    		// cho vao trang dashboard admin
    		$request->session()->put('idSession',$inforAdmin['id']);
    		$request->session()->put('userSession',$inforAdmin['username']);
    		$request->session()->put('emailSession',$inforAdmin['email']);
    		$request->session()->put('roleSession',$inforAdmin['role']);

    		return redirect()->route('admin.dashboard');
    	}else{
    		// dang nhap khong thanh cong
    		// quay ve trang login
    		// luu session flash thong bao loi

    		$request->session()->flash('errorLogin','Username or password invaid');
    		return redirect()->route('admin.login');
    	}

    }
    public function logout(Request $request){
    	//xoa het session ma login tao ra
    	$request->session()->forget('idSession');
    	$request->session()->forget('userSession');
    	$request->session()->forget('emailSession');
    	$request->session()->forget('roleSession');

    	return redirect()->route('admin.login');
    }
}
