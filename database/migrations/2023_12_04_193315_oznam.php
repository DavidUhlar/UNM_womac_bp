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
        Schema::create('oznam', function (Blueprint $table) {
            $table->id();
            $table->string('nazov');
            $table->text('obsah');
            $table->timestamps();
            $table->unsignedBigInteger('autor');
            $table->foreign('autor')->references('id')->on('users')->onDelete('cascade');
            $table->string('image_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('oznam');
    }
};
