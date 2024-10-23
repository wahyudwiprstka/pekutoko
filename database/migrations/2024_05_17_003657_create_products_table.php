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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_ukm');
            $table->integer('id_category');
            $table->integer('id_satuan');
            $table->string('product_name', 255);
            $table->text('description');
            $table->integer('jml_jual_per_satuan');
            $table->double('price');
            $table->tinyInteger('product_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
