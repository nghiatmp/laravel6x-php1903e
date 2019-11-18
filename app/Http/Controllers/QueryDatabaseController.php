<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class QueryDatabaseController extends Controller
{
    public function index(){
    	//thuc hien cac cau lenh truy van o day
    	//lay tat ca du lieu trong bang admin

    	// SELECT * FROM admin
    	$admins = DB::table('admins')->get();
    	// $admin = json_decode(json_encode($admins));
    	$admin = json_decode(json_encode($admins),true);
    	foreach ($admin as $key => $val) {
    		echo $val['id'];
    		echo "<br/>";
    	}
    	dd('aa');

    	// SELECT a.id,a.username,a.password FROM admins As a
    	// $admins = DB::table('admins AS a')
    	// 		->select('a.id','a.username','a.password')
    	// 		->get();


    	// SELECT * FROM admin AS a WHERE a.id =1 AND a.gender = 1 AND role = 1 or a.email = '';
    	// $admins = DB::table('admins AS a')
    			// ->WHERE('a.id',1)
    			// ->where('a.gender',1)
    			// ->WHERE(['a.id'=>1,'a.gender'=>1,'a.role'=>1])
    			// ->orwhere('a.fullname','test abc')
    			// ->first(); 
    	// get() :fetchAll();
    	//first :fetch( );


    	 //SELECT a.id a.username FROM admins As a WHERENOTIN(1,2,3)
    	 // $admins =DB::table('admins AS a')
    	 // 		->select('a.id','a.username')
    	 // 		->WHERENOTIN('a.id',[1,2,3])
    	 // 		->get(); 


    	//SELECT max('a.id'), min('a.id'), avg('a.id') from admins AS a

    	// $admins = DB::table('admins AS a')
    			// ->max('a.id');
    			// ->min('a.id')
    			// ->avg('a.id')
    			// ->get();


    		// SELECT conut(*) from admin
    		// $count = DB::table('admins')->count();
    		// dd($count);


    	// SELECT * FROM admins AS a LIMIT 0,10

    	// $data1 = DB::table('admins')
    	// 		->skip(0)
    	// 		->take(10)
    	// 		->get();
    	// dd($data);


    	// $data2 = DB::table('admins')
    	// 		->offset(5)
    	// 		->limit(10)
    	// 		->get();
    	// dd($data2);

    	// dd($admins);



    	//select * ffrom admins AS a where a.username LIKE '%SSSS%';

    	// $datalike =DB::table('admins AS a')
    	// 		->where('a.username','like','%yv5LX%')
    	// 		->orwhere('a.email','like','%FyB2X@gmail.com%')
    	// 		->get();
    	// dd($datalike);

    	//SELECT a.title ,b.name_cate from posts AS a 
    	// INNER JOIN categories as on a.categories_id =b.id
    	// WHERE a.id =3 

    	// $join = DB::table('posts AS a')
    	// 		->select('a.title','b.name_cate')
    	// 		->join('categories AS b','a.cate_id','=','b.id')
    	// 		->where('a.id',3)
    	// 		->first();

    	// dd($join);



    	// insert +update +delete

    	// INSERT INTO tags(name_tags,description,status,created_at)

    // 	$insert = DB::table('tags')->insert(
    // 		[
    // 				'name_tags'	=> 'test123444',
    // 				'description' => '123445444',
    // 				'status' =>1,
    // 				'created_at'=>date('Y-m-d H:i:s'),
    // 				'updated_at'=>null

    // 		],
    // 		[
    // 				'name_tags'	=> 'test1234',
    // 				'description' => '123445444',
    // 				'status' =>1,
    // 				'created_at'=>date('Y-m-d H:i:s'),
    // 				'updated_at'=>null

    // 		],

    // );
    // 	if($insert){
    // 		echo "OK";
    // 	}else{
    // 		echo "FAIL";
    // 	}



    	// update categories SET a.name_cate = 'test-cate-13' WHERE id = 1;
    	// $update =  DB::table('categories AS a')
    	// 		->where('a.id',1)
    	// 		->update([
    	// 			'a.name_cate'=>'111111',
    	// 			'a.status'  =>0,
    	// 		]);
    	// 	if($update){
    	// 			echo "OK";
    	// 		}else{
    	// 			echo "FAIL";
    	// 		}


    	// DELETE from admins WHERE id =10;

    	// $delete = DB::table('admins')
    	// 		->where('id',10)
    	// 		->delete();

    	// if($delete){
    	// 			echo "OK";
    	// 		}else{
    	// 			echo "FAIL";
    	// 		}

    }


    public function ORM(Admin $admin)
    {
    	$data = $admin->getAllDataAdmin();
    	// dd($data);
    	// foreach ($data as $key => $val) {
    	// 	echo $val['id'];
    	// 	echo "<br/>";
    	// }

    	$infor = $admin->getDataAminById(1);
    	// dd($infor) ;

    	$data2 = $admin->getDataAdminByCondition();
    	dd($data2);


    }
    public function test(){
        $dt = DB::connection('mysqlv2')->table('admins')->get();
        dd($dt);
    }


}
