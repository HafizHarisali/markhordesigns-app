<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectUpdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_project_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();;
            $table->integer('project_status');
            $table->longText('completed_requirements');
            $table->longText('pending_requirements');
            $table->integer('is_new');
            $table->date('date');
            $table->Time('time');

            $table->foreign('project_id')
                  ->references('id')
                  ->on('mk_project_requests')
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
        Schema::dropIfExists('mk_project_updates');
    }
}
