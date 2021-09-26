<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransanctionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transanction_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tx_id');
            $table->integer('buyer_id');
            $table->integer('seller_id');
            $table->integer('product_id');
            $table->string('affiliate_id')->default('NULL');
            $table->string('product_name');
            $table->string('form_name');
            $table->integer('quantity');
            $table->double('price');
            $table->string('transaction_time')->nullable();
            $table->string('order_id')->nullable();
            $table->string('transaction_status')->default('init');
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('transanction_histories');
    }
}