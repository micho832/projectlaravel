<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable(false);
            $table->text('description')->nullable();
            $table->unsignedDecimal('selling_price')->default(0);
            $table->unsignedDecimal('buying_price')->default(0);
            $table->unsignedDecimal('discount')->default(0);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_upcoming')->default(true);
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('image_id')->nullable(true);
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');

            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->onUpdate('CASCADE')
                ->onDelete('SET NULL');
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
