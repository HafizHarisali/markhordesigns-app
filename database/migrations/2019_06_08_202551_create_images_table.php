<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image',100);
            $table->integer('portfolio_id')->unsigned()->nullable();
            $table->integer('package_id')->unsigned()->nullable();
            $table->integer('added_by');
            $table->foreign('portfolio_id')
                  ->references('id')
                  ->on('mk_portfolio')
                  ->onDelete('restrict');
            $table->foreign('package_id')
                  ->references('id')
                  ->on('mk_packages')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mk_images');
    }
}
