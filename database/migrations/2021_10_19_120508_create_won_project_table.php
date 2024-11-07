<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWonProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('won_project', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rfq_no');
            $table->string('project_name');
            $table->string('project_type');
            $table->enum('project_execution', array('Insource','Outsource'))->nullable()->change();
            $table->date('project_start_date');
            $table->date('project_end_date');
            $table->date('date');
            $table->integer('client_total');
            $table->integer('user_id');
            $table->integer('vendor_total');
            $table->integer('client_advance');
            $table->integer('client_balance');
            $table->integer('vendor_advance');
            $table->integer('vendor_balance');
            $table->text('client_contract');
            $table->text('vendor_contract');
            $table->integer('total_margin');
            $table->timestamps();
            $table->foreign('rfq_no')->references('id')->on('bid-rfq')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['id', 'rfq_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('won_project');
    }
}
