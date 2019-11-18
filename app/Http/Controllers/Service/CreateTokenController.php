<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;

class CreateTokenController extends Controller
{
	const API_KEY ='php1903';
    public function index()
    {
    	//du lieu can ma hoa
    	$token = array(
			    "iss" => "PHP",
			    "aud" => "LMN",
			    "iat" => 1572769844, //qui dinh thoi gian song cua token
			    "nbf" => 1572773482
			);
    	//mahoa
    	return JWT::encode($token,self::API_KEY);
    }
}
