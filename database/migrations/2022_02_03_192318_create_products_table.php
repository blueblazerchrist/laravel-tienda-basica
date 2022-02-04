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
            $table->string('product_name')->comment('Nombre del producto');
            $table->string('product_image')->comment('Imagen del producto');
            $table->string('product_slug_name')->comment('Nombre sin caracteres especiales ni espacios');
            $table->string('reference')->comment('Referencia');
            $table->double('sale_price')->nullable()->comment('Precio de compra');
            $table->unsignedBigInteger('category_id')->comment('Id de la categoria');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
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
