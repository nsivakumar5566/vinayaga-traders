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
            $table->increments('id');
            $table->dateTime('order_date');
            $table->unsignedInteger('order_created_by');
            $table->unsignedInteger('customer_id');
            $table->integer('deliver_charge');
            $table->integer('extra_charge')->nullable();
            $table->integer('paid_amount');
            $table->integer('total_amount');
            $table->boolean('fully_paid')->default(1);
            $table->timestamps();

            $table->foreign('order_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
