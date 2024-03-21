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
            $table->unsignedBigInteger('autor');
            $table->string('nazov');
            $table->text('obsah');
            $table->string('image_path')->nullable();
            $table->timestamps();

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
        Schema::drop('oznam');
    }
};
