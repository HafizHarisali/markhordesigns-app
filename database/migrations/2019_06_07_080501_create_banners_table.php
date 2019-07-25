<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image',100);
            $table->integer('status');
            $table->string('location');
            $table->integer('added_by');
            $table->dateTime('created_date_time');
            $table->dateTime('updated_date_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mk_banners');
    }
}
