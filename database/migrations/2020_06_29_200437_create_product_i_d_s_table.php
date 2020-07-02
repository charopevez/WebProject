<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductIDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_i_d_s', function (Blueprint $table) {
            $table->string('BananaId',10);
            $table->string('ISBN',13);
            $table->string('AmazonId',10);
            $table->mediumInteger('AmazonPrice')->unsigned();
            $table->string('YahooId');
            $table->mediumInteger('YahooPrice')->unsigned();
            $table->string('RakutenId');
            $table->mediumInteger('RakutenPrice')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_i_d_s');
    }
}
