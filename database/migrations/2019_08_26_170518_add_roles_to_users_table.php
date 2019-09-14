<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['member', 'admin'])->default('member');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {});
    }
}
