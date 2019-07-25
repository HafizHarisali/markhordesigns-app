<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mk_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30)->nullable();
            $table->string('email',50)->unique();
            $table->string('phone',20)->unique();
            $table->integer('country');
            $table->integer('city');
            $table->longText('address');
            $table->string('image',100);
            $table->integer('verification_code')->unique()->nullable();
            $table->string('password',100);
            $table->integer('added_by');
            $table->integer('role');
            $table->integer('status');
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
        Schema::dropIfExists('mk_users');
    }
}
