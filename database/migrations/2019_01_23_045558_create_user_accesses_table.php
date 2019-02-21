<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('rolesId')->index();
            $table->string('fullname',100);
            $table->string('email',75);
            $table->text('password');
            $table->enum('verified',['0','1']);
            $table->enum('verifiedByAdmin',['0','1']);
            $table->date('lastUpdatePassword');
            $table->enum('loginStatus',['0','1']);
            $table->enum('status',['0','1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_accesses');
    }
}
