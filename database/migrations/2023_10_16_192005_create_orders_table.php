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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('service_information_id')->nullable();
            // $table->uuid('checkout_id')->unique();
            
            $table->integer('checkout_id')->nullable();
            $table->integer('proposal_id')->nullable();
            $table->text('status')->nullable();
            $table->text('role')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
};
