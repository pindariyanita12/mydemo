<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackksTable extends Migration
{
    /**
     * Feedback table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbackks', function (Blueprint $table) {

                $table->id();
                $table->string('name');
                $table->string('email');
                $table->string('subject');
                $table->string('message');
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
        Schema::dropIfExists('feedbackks');
    }
}
