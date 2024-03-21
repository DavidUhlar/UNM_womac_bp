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
        Schema::create('womac', function (Blueprint $table) {
            $table->id()->unsignedBigInteger()->nullable(false)->unique()->autoIncrement();

            $table->unsignedBigInteger('id_womac')->nullable(false);

            $table->date('date_visit')->nullable(false);
            $table->date('date_womac')->nullable(false);

            $table->string('note', 4096)->nullable(true);

            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable(true);
            $table->timestamp('closed_at')->nullable(true);
            $table->timestamp('locked_at')->nullable(true);

            $table->unsignedBigInteger('created_by')->nullable(false);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable(false);
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable(true);
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('closed_by')->nullable(true);
            $table->foreign('closed_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('locked_by')->nullable(true);
            $table->foreign('locked_by')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('womac');
    }
};
