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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('order_id')->nullable();
         
            $table->text('subject')->nullable();
            $table->string('priority')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->string('attachment')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
  
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
};
