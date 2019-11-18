<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->String('title',200)->unique();
                $table->String('slug',255);
                $table->text('sapo');
                $table->bigInteger('cate_id')->unsigned();
                $table->dateTime('publish_date');
                $table->string('avatar',200);
                $table->bigInteger('user_id')->unsigned();
                $table->integer("count_view");
                $table->integer("lang_id")->default(1);
                $table->tinyInteger('status')->default(1);


                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
