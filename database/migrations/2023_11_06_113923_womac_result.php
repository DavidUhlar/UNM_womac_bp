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
        Schema::create('womac_result', function (Blueprint $table) {
            $table->id()->unsignedBigInteger()->nullable(false)->unique()->autoIncrement();

            $table->unsignedBigInteger('id_womac')->nullable(false);

            $table->string('result_name', 16)->nullable(false);
            $table->float('result_value')->nullable(true);
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
