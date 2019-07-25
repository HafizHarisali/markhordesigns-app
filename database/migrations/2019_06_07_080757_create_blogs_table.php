<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->string('slug',130);
            $table->string('featured_image',100);
            $table->longText('description');
            $table->longText('meta_keywords');
            $table->longText('meta_description');
            $table->integer('added_by');
            $table->dateTime('created_date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mk_blogs');
    }
}
