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
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->bigInteger('BananaId')->unsigned();
                $table->foreign('BananaId')->references('BananaId')
                    ->on('product_i_d_s')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->Integer('CategoryId');
                $table->foreign('CategoryId')->references('CategoryId')
                    ->on('categories');
                $table->string('Maker')->nullable();
                $table->string('MakerCode')->nullable();
                $table->string('ItemName')->nullable();
                $table->string('ImgSRC')->nullable();
            });
        }
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
