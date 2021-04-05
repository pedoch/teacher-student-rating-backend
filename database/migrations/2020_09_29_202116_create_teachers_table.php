<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('teacher_id');
            $table->integer('gender');
            $table->integer('user_id')->unsigned;
            $table->integer('department_id')->unsigned;
            $table->timestamps();
        });
        // Schema::table('teachers', function(Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
