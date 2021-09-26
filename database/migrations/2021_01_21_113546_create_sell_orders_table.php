<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transanction_id');
            $table->string('tx_id');
            $table->integer('seller_id');
            $table->integer('buyer_id');
            $table->integer('seller_id');
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('form_name');
            $table->integer('quantity');
            $table->double('price');
            $table->string('document_image')->default(0);
            $table->string('image2')->default(0);
            $table->string('image3')->default(0);
            $table->text('report_description')->nullable();

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
        Schema::dropIfExists('sell_orders');
    }
}