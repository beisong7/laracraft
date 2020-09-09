<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->nullable();
            $table->string('uuid')->nullable();
            $table->string('product_key')->nullable();
            $table->string('email')->nullable();
            $table->text('customer_id')->nullable();
            $table->string('name')->nullable();
            $table->text('info')->nullable();
            $table->bigInteger('time')->nullable();
            $table->integer('flags')->nullable(); //greater than 3 auto hide
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
        Schema::dropIfExists('reviews');
    }
}
