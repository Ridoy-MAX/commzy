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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('proposal_id')->nullable();
            $table->integer('checkout_id')->nullable();
            $table->text('service_name')->nullable();
            $table->text('service_price')->nullable();
            $table->text('commision')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
