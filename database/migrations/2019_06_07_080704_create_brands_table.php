<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',80);
            $table->string('featured_image',100);
            $table->integer('status');
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
        Schema::dropIfExists('mk_brands');
    }
}
