<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('prize');
            $table->integer('count');
            $table->string('type');
            $table->string('status');
            $table->unsignedBigInteger('item_id');
            $table->foriegn('item_id')->references('id')->on('items');
            $table->unsignedBigInteger('customer_id');
            $table->foriegn('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
