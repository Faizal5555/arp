<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string('rfq_no');
            $table->string('supplier_company');
            $table->string('supplier_manager');
            $table->string('supplier_email');
            $table->string('supplier_phone');
            $table->string('supplier_whatsapp');
            $table->string('supplier_country');
            $table->string('other_detail');
            $table->string('email_content');
            $table->string('user_id');

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
        Schema::dropIfExists('supplier');
    }
}
