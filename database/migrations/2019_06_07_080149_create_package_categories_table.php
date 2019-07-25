<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_package_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->nullable();
            $table->string('slug',100)->nullable();
            $table->string('featured_image',100);
            $table->longText('meta_keywords');
            $table->longText('meta_description');
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
        Schema::dropIfExists('mk_package_categories');
    }
}
