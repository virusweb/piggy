<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterFdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fixed_deposits', function (Blueprint $table) {
            $table->dropForeign('fixed_deposits_bank_foreign');
            $table->renameColumn('bank', 'bank_id');
            $table->foreign('bank_id')->references('id')->on('bank_lists')->onDelete('cascade')->change();
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
