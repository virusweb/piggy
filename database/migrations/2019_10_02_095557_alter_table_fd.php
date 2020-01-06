<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixed_deposits', function (Blueprint $table) {
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('bank_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fixed_deposits', function (Blueprint $table) {
            //
        });
    }
}
