<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('upload_id')->nullable();
            $table->longText('main_text')->nullable();
            $table->longText('more_text')->nullable();
            $table->boolean('button')->nullable();
            $table->boolean('is_url')->nullable();
            $table->string('button_url')->nullable();
            $table->string('slider_url')->nullable();
            $table->string('button_text')->nullable();
            $table->string('uuid')->nullable();
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
