<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->nullable()->unique();
            $table->string('name')->nullable();
            $table->float('price')->nullable();
            $table->boolean('is_new')->nullable();
            $table->string('old_price')->nullable();
            $table->string('category_id')->nullable();
            $table->string('maker_id')->nullable();
            $table->boolean('active')->nullable();
            $table->text('thumb1')->nullable();
            $table->text('thumb2')->nullable();
            $table->text('pic1')->nullable();
            $table->text('pic2')->nullable();
            $table->text('pic3')->nullable();
            $table->text('pic4')->nullable();
            $table->boolean('featured')->nullable();
            $table->text('details')->nullable();
            $table->boolean('discount')->nullable();
            $table->integer('view_count')->nullable(); //number of views
            $table->integer('sold_count')->nullable(); //number of sales
            $table->integer('qty')->nullable(); //quantity available
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
        Schema::dropIfExists('products');
    }
}
