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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            // $table->integer('user_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->integer('service_information_id')->nullable();
            $table->text('price')->nullable();
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->integer('delivery_time')->default(0);
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
        Schema::dropIfExists('proposals');
    }
};
