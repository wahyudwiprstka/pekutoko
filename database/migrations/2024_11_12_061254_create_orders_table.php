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
            $table->integer('id_ukm');
            $table->string('full_name', 255);
            $table->text('address');
            $table->string('regency', 255);
            $table->string('postal_code', 10);
            $table->string('phone_number', 20);
            $table->string('email', 255);
            $table->text('notes');
            $table->text('order_detail');
            $table->double('total_price');
            $table->tinyInteger('order_status');
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
