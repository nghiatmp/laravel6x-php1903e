<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/hello',function(){
	return "hello world";
});
Route::post('/demo-post',function(){
	return ('this is method post');
});
Route::put('/demo-put',function(){
	return ('this is mothod put');
});

Route::redirect('/hello', '/',301);


Route::get('/test-view', function(){
	return view('test_view');
});



Route::get('samsung/{id}',function($idpd){
	return "samsung -{$idpd}";
});

Route::get('iphone/{name?}',function($name =  null){
	return "samsung -{$name}";
})->where('name','[A-Za-z]+');

Route::get('/sony/{id}/{name?}',function($idpd,$name=null){
	return "sony-{$idpd}-{$name}";
})->where(['id'=>'[A-Za-z+]']);


Route::get('search/{keyword}',function($key){
	return("Ban vua tim kiem : {$key}");
})->where('keyword','.*');


Route::get('name-route-demo', function(){
	return('test name routing');
})->name('mynameRoute');

Route::get('watch-flim',function(){
	// return redirect()->route('mynameRoute');
	$url = route('mynameRoute');
	return $url;
});
// for admin

//group routing
Route::group([
	'prefix'=>'admin', 
	'as' =>'admin.',
	'namespace'=>'Admin'
	],
	function(){
		Route::get('/login','LoginController@index')->name('login');
		Route::post('admin-login','LoginController@handleLogin')->name('handleLogin');
		Route::post('admin-logout','LoginController@logout')->name('handleLogout');


});
/***************Test Query*******************/


Route::group(['prefix'=>'db'],function(){
	Route::get('get','QueryDatabaseController@index')->name('queryGet');
	Route::get('orm','QueryDatabaseController@ORM')->name('ORM');
	Route::get('test','QueryDatabaseController@test')->name('test');
});
Route::group([
	'prefix'=>'admin', 
	'as' =>'admin.',
	'namespace'=>'Admin',
	'middleware'=>['web','check.admin.login']
	],
	function(){

		Route::get('/dashboard','DashboardController@index')->name('dashboard');


		Route::get('/post','PostController@index')->name('post');
		Route::get('/create-post','PostController@createpost')->name('createPost');
		Route::post('handle-create-post','PostController@handleCreatePost')->name('handlecreatePost');

		Route::post('deletePost','PostController@deletePost')->name('deletePost');
		Route::get('{slug}~{id}','PostController@edit')->name('editPost');
		Route::post('updatePost/{id}','PostController@handleUpdatePost')->name('handleupdatePost');


		Route::get('/category','CategoryController@index')->name('category');


		Route::get('/user','UserController@index')->name('user');


		Route::get('/tag','TagController@index')->name('tag');

});
/***************Test Query*******************/


Route::group(['prefix'=>'db'],function(){
	Route::get('get','QueryDatabaseController@index')->name('queryGet');
	Route::get('orm','QueryDatabaseController@ORM')->name('ORM');
	Route::get('test','QueryDatabaseController@test')->name('test');
});
/*************** END   Test Query*******************/

/*************ENDADMIN******************/


Route::get('login',function(){
	//truy cap vao dc homeadmin
	return redirect()->route('admin.home');
});
//cho phep custom mac sinh cua laravel
Route::fallback(function(){
	return 'not found 404';
});
//magic mwthod : __Call($r,$q);



Route::get('film/{age}',function($age){
//dung middleware
	 return redirect()->route('film1');
})->middleware('check.age:admin');
// admin (admin la gia tri ) tham so truyen vao middleware 

Route::get('watch-all-film',function(){
	return "chuc ban xem vui ve";
})->name('film1');
Route::get('watch-all-film-v2',function(){
	return "chua du tuoi e xem";
})->name('film2');



Route::get('checkNumber/{number}',function($number){
	return "this number- {$number}";
})->middleware('check.number');

Route::get('not-a-number',function(){
	return('khong phai la so chan');
})->name('nan');


//Controller 
Route::get('democontroller','DemoController@index')->name('index');
Route::get('democontroller-test','DemoController@test')->name('test');

// Route::get('Testcontroller-index','Example\TestController@index')->name('test.index');

// Route::get('Expcontroller-index','Example\ExpController@index')->name('exp.index');

Route::group([
	'namespace'=>'Example',
	// 'middleware'=>'check.user'
	],function(){
	 Route::get('Testcontroller-index/{user}','TestController@index')->name('test.index');
	 Route::get('Testcontroller-demodata/{user}','TestController@demoData')->name('test.demoData');
	  Route::get('Testcontroller-viewData/{user}','TestController@viewData')->name('test.viewData');

	 Route::get('Expcontroller-index','ExpController@index')->name('exp.index');
	 Route::get('exp-3/{id}/{age}/{money}/{address?}','ExpController@demo')->name('exp.demo');

	 Route::get('login','ExpController@login')->name('user.login');
	 Route::post('handle-login','ExpController@handleLogin')->name('user.login');
});

// //////////////////////////////////////////////////////////////////////////////////////

// FRONTEND

Route::group([
	'namespace'=>'Frontend',
	'as'       =>'fr.'
],function(){
		Route::get('/','HomeController@index')->name('home');
		Route::get('{slug}','DetailBlogController@index')->name('detailBlog');
		Route::post('UpdateCountView','DetailBlogController@UpdateCountView')->name('UpdateCountView');
		Route::get('categories/{slug}~{id}','CategoryController@listCate')->name('categories');
		Route::get('tag/{slug}~{id}','TagController@listTag')->name('tag');

		Route::get('searche/key','SearchController@index')->name('searchBlog');

		Route::get('searche/ajax','SearchController@ajaxSearch')->name('ajaxSearch');

});

//Web Service

Route::group(['namespace'=> 'Service','as'=>'service.'],function(){
		Route::get('create-token','CreateTokenController@index')->name('createToken');
});


