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
        Schema::create('has_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('id_prispevku');
            $table->unsignedBigInteger('id_tagu');

            $table->foreign('id_prispevku')->references('id')->on('oznam')->onDelete('cascade');
            $table->foreign('id_tagu')->references('id')->on('tag')->onDelete('cascade');
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
