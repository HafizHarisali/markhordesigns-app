<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_blog_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id');
            $table->integer('from_user_id');
            $table->integer('to_user-id');
            $table->longText('comment');
            $table->dateTime('date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mk_blog_comments');
    }
}
