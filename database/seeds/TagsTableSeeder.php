<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=10 ; $i++) { 
        	DB::table('tags')->insert([
        		'name_tags'=> Str::random(5),
        		'description'=>Str::random(12),

        	]);
        }
    }
}
