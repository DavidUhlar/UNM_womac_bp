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
        Schema::create('d_pacient', function (Blueprint $table) {
            $table->id()->unsignedBigInteger()->nullable(false)->unique()->autoIncrement();

            $table->string('meno', 50)->nullable(false);
            $table->string('priezvisko', 50)->nullable(false);
            $table->string('rc', 11)->nullable(true);

            $table->string('adr_ulica', 255)->nullable(true);
            $table->string('adr_mesto', 255)->nullable(true);
            $table->string('adr_psc', 255)->nullable(true);
            $table->string('tel', 50)->nullable(true);


            $table->unsignedTinyInteger('pohl')->nullable(true);
            $table->unsignedTinyInteger('f_not_active')->nullable(false);
            $table->unsignedBigInteger('active_id')->nullable(true);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('d_pacient');
    }
};
