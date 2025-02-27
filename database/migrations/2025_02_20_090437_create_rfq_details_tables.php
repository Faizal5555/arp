<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqDetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_details_tables', function (Blueprint $table) {
            $table->id();
            $table->string('rfq_no'); // Required
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Required
            $table->date('date')->nullable();
            $table->string('industry')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->string('company_name')->nullable();
            $table->text('comments')->nullable();
            $table->enum('type', ['won', 'lost', 'next'])->default('next')->change();
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
        Schema::dropIfExists('rfq_details_tables');
    }
}
