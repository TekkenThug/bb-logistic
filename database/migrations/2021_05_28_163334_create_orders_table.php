<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('not-allocated');
            $table->BigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            $table->BigInteger('courier_id')->nullable()->default(null)->unsigned();
            $table->foreign('courier_id')->references('id')->on('users');
            $table->string('delivery_type');
            $table->string('delivery_date');
            $table->string('delivery_time');
            $table->string('delivery_address');
            $table->string('delivery_fio');
            $table->text('delivery_phones');
            $table->string('delivery_cost');
            $table->string('delivery_pay')->nullable()->default(null);
            $table->text('delivery_comment')->nullable()->default(null);
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
        Schema::dropIfExists('orders');
    }
}
