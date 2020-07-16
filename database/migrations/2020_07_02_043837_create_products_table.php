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
            $table->string('BananaId');
            $table->foreign('BananaId')->references('BananaId')
                                                ->on('product_i_d_s')
                                                ->onDelete('cascade')
                                                ->onUpdate('cascade');
            $table->Integer('CategoryId');
            $table->foreign('CategoryId')->references('CategoryId')
                                                ->on('categories');
            $table->string('Maker');
            $table->string('MakerCode')->nullable();
            $table->string('ItemName');
            $table->string('color',10);
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
