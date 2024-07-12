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
        Schema::create('pending_payment_models', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('days')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            // $table->integer('amount')->nullable();
            $table->date('clearance_date')->nullable();
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
        Schema::dropIfExists('pending_payment_models');
    }
};
