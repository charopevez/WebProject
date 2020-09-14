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
        if (!Schema::hasTable('product_i_d_s')) {
            Schema::create('product_i_d_s', function (Blueprint $table) {
                $table->bigInteger('BananaId', 10)->unsigned();
                $table->string('AmazonId', 10);
                $table->string('JAN', 13)->nullable();
                $table->string('AmazonLink')->nullable();
                $table->mediumInteger('AmazonPrice')->unsigned()->nullable();
                $table->string('YahooLink')->nullable();
                $table->mediumInteger('YahooPrice')->unsigned()->nullable();
                $table->string('Link')->nullable();
                $table->mediumInteger('Price')->unsigned()->nullable();
                $table->date('YahooLinkWasUpdatedAt')->unsigned()->nullable();
                $table->string('RakutenLink')->nullable();
                $table->mediumInteger('RakutenPrice')->unsigned()->nullable();
                $table->date('RakutenLinkWasUpdatedAt')->unsigned()->nullable();
                $table->unique(['BananaId','AmazonId']);
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
        Schema::dropIfExists('product_i_d_s');
    }
}
