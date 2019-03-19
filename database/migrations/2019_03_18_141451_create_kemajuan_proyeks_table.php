<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemajuanProyeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemajuan_proyeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->date('reportDate');
            $table->binary('photo');
            $table->integer('percentage');

            $table->bigInteger('pelaksanaan_id')->unsigned();
            $table->foreign('pelaksanaan_id')
            ->references('id')
            ->on('pelaksanaans')
            ->onUpdate('cascade')
            ->onDelete('cascade');


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
        Schema::dropIfExists('kemajuan_proyeks');
    }
}