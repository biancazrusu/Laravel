<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('estimate_id');
            $table->foreign('estimate_id')->references('id')
                ->on('estimates')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('question_id');
            $table->foreign('question_id')->references('id')
                ->on('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('answer_id');
            $table->foreign('answer_id')->references('id')
                ->on('answers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('estimate_responses');
    }
}
