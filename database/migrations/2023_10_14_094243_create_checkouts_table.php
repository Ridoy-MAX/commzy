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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('service_information_id')->nullable();
            $table->text('name')->nullable();
            $table->text('email')->nullable();
            $table->text('company')->nullable();
            $table->text('country')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('house')->nullable();
            $table->text('apartment')->nullable();
            $table->text('phone')->nullable();
            $table->text('additional')->nullable();
            $table->text('service_name')->nullable();
            $table->text('service_price')->nullable();
            $table->text('shipping_price')->nullable();
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
        Schema::dropIfExists('checkouts');
    }
};
