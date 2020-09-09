<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('google')->nullable();
            $table->text('youtube')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->text('mail1')->nullable();
            $table->text('mail2')->nullable();
            $table->text('boss_email')->nullable();
            $table->text('copyright')->nullable();
            $table->text('powered')->nullable();
            $table->text('logo1')->nullable();
            $table->text('logo2')->nullable();
            $table->text('phone')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
