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
        Schema::create('service_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            // $table->string('slug')->unique()->nullable();
            $table->integer('category_id')->nullable();
            $table->text('service_title')->nullable();
            $table->text('price')->nullable();
            $table->text('delivery_time')->nullable();
            $table->text('skill')->nullable();
            $table->text('tag')->nullable();
            $table->text('country')->nullable();
            $table->text('languages')->nullable();
            $table->text('service_detail')->nullable();
            $table->text('meta_title')->nullable();
            // $table->text('meta_query')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('status')->nullable();
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
        Schema::dropIfExists('service_information');
    }
};
