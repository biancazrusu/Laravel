<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('child_id')->nullable();
            $table->foreign('child_id')->references('id')->on('questions')->onDelete('set null')->onUpdate('cascade');
            $table->integer('price');
            $table->string('text');
            $table->string('image')->nullable();
            $table->boolean('status');
            $table->integer('position')->nullable();
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
