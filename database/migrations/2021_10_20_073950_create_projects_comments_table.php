<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comments');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rfq_no');
            $table->timestamps();
            $table->foreign('rfq_no')->references('id')->on('bid-rfq')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects_comments');
    }
}
