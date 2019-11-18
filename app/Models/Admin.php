<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model
{
    //qui uoc lam viec voi table admin
    protected $table = 'admins';


    public function getAllDataAdmin(){
    	$newdata = [];
    	$data = Admin::all();
    	if($data){
    		$newdata = $data->toArray();
    	}
    	return $newdata;
    }
    public function getDataAminById($id = 0){
    	$infor = [];
    	$data = Admin::find($id);
    	if($data){
    		$infor = $data->toArray();
    	}
    	return $infor;

    }
    public function getDataAdminByCondition(){
    	$data = Admin::select('*')
    			->where('id',2)
    			->first();
    	if($data){
    		$data = $data->toArray();
    	}
    	return $data;
    }


    public function checkAdminLogin($user,$pass)
    {
        $data = [];
        $infor=Admin::select('*')
                ->where(['email'=>$user,'password'=>$pass,'status'=>1])
                ->first();

        if($infor){
            $data = $infor->toArray();
        }
        return $data;
    }

    public static function deleteDataByID($id)
    {
        $del = DB::table('admins')
                ->where('id',$id)
                ->delete();
        return $del;
    }
}
