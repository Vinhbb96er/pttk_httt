<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('name');
            $table->boolean('gender');
            $table->date('birthday');
            $table->string('address');
            $table->string('phone');
            $table->string('image')->nullable();
            $table->date('reception_date');
            $table->string('insurance_number')->nullable();
            $table->date('expiration_date')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
