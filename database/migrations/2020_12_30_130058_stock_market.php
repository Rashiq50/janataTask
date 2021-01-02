<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StockMarket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_market', function (Blueprint $table) {
            $table->id();
            $table->string('trade_code');
            $table->timestamp('date');
            $table->float('high');
            $table->float('low');
            $table->float('open');
            $table->float('close');
            $table->integer('volume');
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
        Schema::dropIfExists('stock_market');
    }
}
