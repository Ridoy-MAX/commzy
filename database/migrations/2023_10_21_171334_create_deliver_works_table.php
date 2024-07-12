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
        Schema::create('deliver_works', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->string('file')->nullable();
            $table->text('comment')->nullable();
            $table->text('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliver_works');
    }
};
