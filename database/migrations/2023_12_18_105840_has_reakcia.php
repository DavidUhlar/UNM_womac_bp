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
        Schema::create('reakcia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_prispevku');
            $table->unsignedBigInteger('autor_reakcie');
            $table->boolean('reakcia')->default(false);
            $table->timestamps();

            $table->foreign('id_prispevku')->references('id')->on('oznam')->onDelete('cascade');
            $table->foreign('autor_reakcie')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reakcia');
    }
};
