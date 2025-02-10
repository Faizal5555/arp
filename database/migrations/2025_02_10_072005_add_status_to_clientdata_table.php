<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToClientdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientdata', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('clientdata', 'status')) {
                $table->enum('status', ['Client', 'Important', 'Normal', 'Not Responsive'])
                      ->after('email_address')
                      ->default('Client');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientdata', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
