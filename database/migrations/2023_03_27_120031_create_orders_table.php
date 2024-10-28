<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignId('store_id')->nullable()->constrained('stores');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('cart_id',50);
            $table->string('number')->unique();
            $table->string('payment_method');
            $table->enum('status',['pending','processing','delivering','completed','cancelled','refunded'])->default('pending');
            $table->enum('payment_status',['pending','paid','failed'])->default('pending'); 
            $table->float('shipping')->default(0);
            $table->float('percent')->default(0);
            $table->float('tax')->default(0);
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->nullOnDelete();
            // $table->float('discount')->default(0);
            $table->float('total')->default(0);
  
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
};
