<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLitersTable extends Migration
{
    /**
     * Liters table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('area');
            $table->date('date');
            $table->string('day');
            $table->string('time');

            $table->string('liter');
            $table->string('rupees');

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
        Schema::dropIfExists('liters');
    }
}
