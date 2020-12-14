<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('orders');
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('usuarios');

            $table->string('status');
            $table->string('currency');
            $table->double('total');
            $table->string('payment_method');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }


    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
