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

//            $table->unsignedBigInteger('id_womac')->nullable(false);
//            $table->unsignedBigInteger('id_patient')->nullable(false);
//            $table->unsignedBigInteger('id_operation')->nullable(false);
            $table->unsignedBigInteger('id_visit')->nullable(false);


            // Pacient ID
            $table->unsignedBigInteger('id_patient')->nullable(false);
            $table->foreign('id_patient')->references('id')->on('d_pacient')->onDelete('cascade');

            // Operacie ID
            $table->unsignedBigInteger('id_operation')->nullable(false);
            $table->foreign('id_operation')->references('id')->on('d_operacia')->onDelete('cascade');

            // Womac ID
            $table->unsignedBigInteger('id_womac')->nullable(false);;
            $table->foreign('id_womac')->references('id_womac')->on('womac')->onDelete('cascade');

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
