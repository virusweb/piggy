<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToSipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('sips');
        Schema::create('sips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('folio_no');
            $table->string('scheme_name');
            $table->string('email');
            $table->string('mobile');
            $table->float('amount');
            $table->bigInteger('installment');
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
        Schema::table('sips', function (Blueprint $table) {
            //
        });
    }
}
