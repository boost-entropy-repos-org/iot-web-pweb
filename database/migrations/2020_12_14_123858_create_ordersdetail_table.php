<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersdetailTable extends Migration
{
    public function up()
    {
        Schema::create('ordersdetail', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('orders');

            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')->references('id')->on('products');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordersdetail');
    }
}
