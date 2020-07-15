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
            $table->string('BananaId',10)->primary();
            $table->string('AmazonId',10);
            $table->string('JAN',13)->nullable();
            $table->string('MakerCodes')->nullable();
            $table->string('AmazonLink')->nullable();
            $table->mediumInteger('AmazonPrice')->unsigned()->nullable();
            $table->string('YahooLink')->nullable();
            $table->mediumInteger('YahooPrice')->unsigned()->nullable();
            $table->string('RakutenLink')->nullable();
            $table->mediumInteger('RakutenPrice')->unsigned()->nullable();
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
