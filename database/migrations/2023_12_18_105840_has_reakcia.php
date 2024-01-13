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
            $table->string('autor_reakcie');
            $table->boolean('reakcia')->default(false);
            $table->timestamps();

            $table->foreign('id_prispevku')->references('id')->on('oznam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
