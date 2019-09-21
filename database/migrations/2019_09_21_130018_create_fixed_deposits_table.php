<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('amount');
            $table->string('account_no');
            $table->string('bank');
            $table->string('branch');
            $table->date('starting_date');
            $table->date('ending_date');
            $table->float('intrest_rate');
            $table->double('maturity_amount');
            $table->boolean('auto_renewal');
            $table->boolean('auto_closer');
            $table->double('receipt_no');
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
        Schema::dropIfExists('fixed_deposits');
    }
}
