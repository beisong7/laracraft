<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('txref')->nullable(); //transaction ref
            $table->string('payment_id')->nullable();
            $table->string('cart_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('value')->nullable();
            $table->float('amount')->nullable();
            $table->string('status')->nullable();
            $table->boolean('completed')->nullable();
            $table->text('gateway_message')->nullable();
            $table->bigInteger('start')->nullable(); // time the payment was initiated
            $table->bigInteger('ends')->nullable(); // time the payment was successful or not
            $table->text('details')->nullable(); // logs for the payment from start to finish
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
        Schema::dropIfExists('transactions');
    }
}
