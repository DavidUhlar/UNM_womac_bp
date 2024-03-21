<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prispevku');
            $table->text('obsah');
            $table->timestamps();
            $table->unsignedBigInteger('autor');


            $table->foreign('id_prispevku')->references('id')->on('oznam')->onDelete('cascade');
            $table->foreign('autor')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('komentar');
    }
};
