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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->text('banner_title')->nullable();
            $table->text('banner_description')->nullable();

            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();

            $table->text('iconbox_one_title')->nullable();
            $table->text('iconbox_one_detail')->nullable();
            $table->text('iconbox_two_title')->nullable();
            $table->text('iconbox_two_detail')->nullable();
        
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
        Schema::dropIfExists('banners');
    }
};
