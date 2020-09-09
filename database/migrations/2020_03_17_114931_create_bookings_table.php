<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('seen')->nullable();
            $table->boolean('handled')->nullable();
            $table->boolean('replied')->nullable();
            $table->string('email')->nullable();
            $table->text('customer_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('name')->nullable();
            $table->boolean('canceled')->nullable();
            $table->string('uuid')->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
