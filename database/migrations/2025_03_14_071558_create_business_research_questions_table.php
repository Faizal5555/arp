<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessResearchQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_research_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_research_id');
            $table->unsignedBigInteger('user_id');
            $table->text('question');
            $table->text('answer');
            $table->timestamps();

            $table->foreign('business_research_id')->references('id')->on('business_research')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_research_questions');
    }
}
