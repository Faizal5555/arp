<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectCompletedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_completed', function (Blueprint $table) {
            $table->id();
            $table->string('clientadvance');
            $table->string('clientbalance');
            $table->string('vendoradvance');
            $table->string('vendorbalance');
            $table->text('respondentfile');
            $table->text('clientinvoicefile');
            $table->text('vendorinvoicefile');
            $table->text('client_confirmation');
            $table->text('vendor_confirmation');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
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
        Schema::dropIfExists('project_completed');
    }
}
