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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('position_id');
            $table->string('faculty_id');
            $table->string('name');
            $table->date('birthday');
            $table->boolean('gender');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->integer('role');
            $table->string('account')->unique();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
