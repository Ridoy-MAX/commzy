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
        Schema::create('award_winners', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('title');
            $table->text('description');
            $table->integer('satisfied_percentage');
            $table->text('satisfied_details');
            $table->text('professionals_details');
            $table->integer('professionals_number_one');
            $table->integer('professionals_number_two');
            $table->integer('devided_number');
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
        Schema::dropIfExists('award_winners');
    }
};
