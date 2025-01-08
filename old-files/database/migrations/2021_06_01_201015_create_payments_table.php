<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *  paymentPos:
         *  start - Платеж в начале (у клиента)
         *  courier - Платеж у курьера
         *  admin - Платеж у курьера
         *  finish - Платеж сдан клиенту
         */
        Schema::create('payments', function (Blueprint $table) {
            $table->BigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->boolean('isCredit')->nullable()->default(null);
            $table->string('paymentPos')->default('start');
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
        Schema::dropIfExists('payments');
    }
}
