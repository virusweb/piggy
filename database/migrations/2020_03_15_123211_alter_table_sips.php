<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sips', function (Blueprint $table) {
            $table->double('unit_balance')->after('scheme_name');
            $table->double('last_declare_nav')->after('unit_balance');
            $table->double('current_value')->after('last_declare_nav');
            $table->double('cost_value')->after('current_value');
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')->references('id')->on('bank_accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sips', function (Blueprint $table) {
            //
        });
    }
}
