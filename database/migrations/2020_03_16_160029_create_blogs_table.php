<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->nullable();
            $table->text('title')->nullable();
            $table->text('desc')->nullable();
            $table->longText('detail')->nullable();
            $table->integer('category_id')->nullable();
            $table->longText('tags')->nullable(); //relative post
            $table->string('type')->nullable(); //
            $table->longText('keywords')->nullable();
            $table->longText('banner')->nullable();
            $table->integer('user_id')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('hits')->default(0);
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
        Schema::dropIfExists('blogs');
    }
}
