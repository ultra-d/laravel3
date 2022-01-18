<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserStatusFieldToBoolean extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status')->default(true)->change();
        });
    }

    public function down():void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('status')->default(1)->change();
        });
    }
}
