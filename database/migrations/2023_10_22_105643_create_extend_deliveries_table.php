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
        Schema::create('extend_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->text('delivery_time')->nullable();
            $table->text('reason')->nullable();
            $table->text('status')->nullable();
            $table->text('new_delivery_time')->nullable();
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
        Schema::dropIfExists('extend_deliveries');
    }
};
