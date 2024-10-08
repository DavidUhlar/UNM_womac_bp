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
        Schema::create('womac_answers', function (Blueprint $table) {
            $table->id()->unsignedBigInteger()->nullable(false)->unique()->autoIncrement();
            $table->unsignedBigInteger('id_womac')->nullable(false);
            $table->foreign('id_womac')->references('id')->on('womac')->onDelete('cascade');
            $table->unsignedTinyInteger('answer_01')->nullable(true);
            $table->unsignedTinyInteger('answer_02')->nullable(true);
            $table->unsignedTinyInteger('answer_03')->nullable(true);
            $table->unsignedTinyInteger('answer_04')->nullable(true);
            $table->unsignedTinyInteger('answer_05')->nullable(true);
            $table->unsignedTinyInteger('answer_06')->nullable(true);
            $table->unsignedTinyInteger('answer_07')->nullable(true);
            $table->unsignedTinyInteger('answer_08')->nullable(true);
            $table->unsignedTinyInteger('answer_09')->nullable(true);
            $table->unsignedTinyInteger('answer_10')->nullable(true);
            $table->unsignedTinyInteger('answer_11')->nullable(true);
            $table->unsignedTinyInteger('answer_12')->nullable(true);
            $table->unsignedTinyInteger('answer_13')->nullable(true);
            $table->unsignedTinyInteger('answer_14')->nullable(true);
            $table->unsignedTinyInteger('answer_15')->nullable(true);
            $table->unsignedTinyInteger('answer_16')->nullable(true);
            $table->unsignedTinyInteger('answer_17')->nullable(true);
            $table->unsignedTinyInteger('answer_18')->nullable(true);
            $table->unsignedTinyInteger('answer_19')->nullable(true);
            $table->unsignedTinyInteger('answer_20')->nullable(true);
            $table->unsignedTinyInteger('answer_21')->nullable(true);
            $table->unsignedTinyInteger('answer_22')->nullable(true);
            $table->unsignedTinyInteger('answer_23')->nullable(true);
            $table->unsignedTinyInteger('answer_24')->nullable(true);

            $table->string('filled', 16)->nullable(false);

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable(true);
            $table->timestamp('closed_at')->nullable(true);

            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable(false);
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable(true);
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('womac_answers');
    }
};
