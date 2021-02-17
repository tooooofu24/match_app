<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id');
            $table->string('nickname');
            $table->integer('gender');
            $table->integer('grade');
            $table->integer('q1');
            $table->integer('q2');
            $table->integer('q3');
            $table->integer('q4');
            $table->integer('q5');
            $table->integer('q6');
            $table->integer('q7');
            $table->integer('q8');
            $table->integer('q9');
            $table->integer('q10')->nullable();
            $table->integer('q11')->nullable();
            $table->integer('q12')->nullable();
            $table->integer('q13')->nullable();
            $table->integer('q14')->nullable();
            $table->integer('q15')->nullable();
            $table->integer('q16')->nullable();
            $table->integer('q17')->nullable();
            $table->integer('q18')->nullable();
            $table->integer('q19')->nullable();
            $table->integer('q20')->nullable();
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
        Schema::dropIfExists('answers');
    }
}
