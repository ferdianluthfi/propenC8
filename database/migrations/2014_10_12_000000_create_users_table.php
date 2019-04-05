<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            /**
             * 1 = akun manajer
             * 2 = direksi
             * 3 = staf marketing
             * 4 = manajer marketing
             * 5 = program manajer
             * 6 = manajer pelaksana
             * 7 = pm
             * 8 = klien
             */
            $table->integer('role');
            $table->rememberToken();

            $table->timestamps();

            /**
             * digunakan di iterasi ke dua
             */
            //$table->string('username');
            //$table->binary('photo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
