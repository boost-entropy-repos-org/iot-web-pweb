<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_auth');
            $table->foreign('id_auth')->references('id')->on('usuarios')->onDelete("cascade");
            $table->unsignedBigInteger('id_recip');
            $table->foreign('id_recip')->references('id')->on('usuarios')->onDelete("cascade");
            $table->string('message');

            $table->char('pm');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
