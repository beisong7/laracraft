<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_key')->nullable();
            $table->string('uuid')->nullable();
            $table->string('reference')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('email')->nullable();
            $table->string('order_id')->nullable();
            $table->bigInteger('kobo')->nullable();
            $table->text('details')->nullable(); // logs for the payment from start to finish
            $table->boolean('success')->nullable(); //true or false
            $table->string('amount')->nullable(); // amount in words
            $table->string('status')->nullable(); // phases of the payment. [attempting, successful, completed-with-success, completed-with-failure]
            $table->text('gateway_message')->nullable();
            $table->bigInteger('start')->nullable(); // time the payment was initiated
            $table->bigInteger('ends')->nullable(); // time the payment was successful or not
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
        Schema::dropIfExists('payments');
    }
}
