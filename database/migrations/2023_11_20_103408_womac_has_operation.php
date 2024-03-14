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
//            $table->primary(['id_patient', 'id_operation','id_womac']);


            $table->unsignedBigInteger('id_visit')->nullable(false);


            // Pacient ID
            $table->unsignedBigInteger('id_patient')->nullable(false);
            $table->foreign('id_patient')->references('id')->on('d_pacient')->onDelete('cascade');

            // Operacie ID
            $table->unsignedBigInteger('id_operation')->nullable(false);
            $table->foreign('id_operation')->references('id')->on('d_operacia')->onDelete('cascade');

            // Womac ID
            $table->unsignedBigInteger('id_womac')->nullable(false);
            $table->foreign('id_womac')->references('id')->on('womac')->onDelete('cascade');


            $table->timestamp('closed_at')->nullable(true);
            $table->unsignedBigInteger('closed_by')->nullable(true);
            $table->foreign('closed_by')->references('id')->on('users')->onDelete('cascade');
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
