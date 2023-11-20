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
        Schema::create('womac_has_operation', function (Blueprint $table) {
            $table->id()->unsignedBigInteger()->nullable(false)->unique()->autoIncrement();

            $table->unsignedBigInteger('id_womac')->nullable(false);
            $table->unsignedBigInteger('id_pacient')->nullable(false);
            $table->unsignedBigInteger('id_operacia')->nullable(false);
            $table->unsignedBigInteger('id_vizita')->nullable(false);
            $table->unsignedTinyInteger('id_typ_operacie')->nullable(false);



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
