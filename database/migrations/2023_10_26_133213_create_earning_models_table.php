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
        Schema::create('earning_models', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->decimal('net_income', 10, 2)->nullable();
            $table->decimal('withdrawn', 10, 2)->nullable();
            $table->decimal('pending_clearance', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();


       
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
        Schema::dropIfExists('earning_models');
    }
};
