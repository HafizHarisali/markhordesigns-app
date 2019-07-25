<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_portfolio_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('slug',120);
            $table->string('featured_image',100);
            $table->longText('meta_keywords');
            $table->longText('meta_decription');
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
        Schema::dropIfExists('mk_portfolio_categories');
    }
}
