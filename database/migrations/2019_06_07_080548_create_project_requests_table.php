<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_project_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('request_id');
            $table->integer('user_id')->unsigned()->nullable();;
            $table->integer('package_id')->unsigned()->nullable();;
            $table->string('requirements',100);
            $table->integer('status');
            $table->date('request_date');
            $table->Time('request_time');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('mk_users')
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
        Schema::dropIfExists('mk_project_requests');
    }
}
