<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         for ($i=1; $i <=10 ; $i++) { 
        	DB::table('categories')->insert([
        		'name_cate'=> Str::random(5),
        		'parent_id'=>0,
        		'status'   =>1,
        		'created_at'=>date('Y-m-d H:i:s'),

        	]);
        }
    }
}
