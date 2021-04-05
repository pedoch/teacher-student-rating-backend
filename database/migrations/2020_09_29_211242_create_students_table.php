<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('matric_no');
            $table->integer('gender');
            $table->integer('user_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->timestamps();
        });
        // Schema::table('students', function(Blueprint $table) {
        //     $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');;
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
