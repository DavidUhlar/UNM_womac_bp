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
        Schema::create('d_operacia', function (Blueprint $table) {
            $table->id()->unsignedBigInteger()->nullable(false)->unique()->autoIncrement();

            $table->string('sar_id', 11)->nullable(false);
            $table->unsignedTinyInteger('typ')->nullable(false);
            $table->unsignedTinyInteger('subtyp')->nullable(false);
            $table->string('datum', 14)->nullable(false);
            $table->unsignedTinyInteger('id_prac')->nullable(false);
            $table->unsignedTinyInteger('id_pac')->nullable(false);
            $table->unsignedTinyInteger('_valid')->nullable(false);
            $table->unsignedTinyInteger('stat_valid')->nullable(false);
            $table->unsignedBigInteger('old_id_pac')->nullable(false);
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
