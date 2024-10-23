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
        Schema::create('ukm', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('ukm_name', 255);
            $table->text('ukm_address');
            $table->string('wa_pic', 20);
            $table->string('ukm_email', 255);
            $table->tinyInteger('ukm_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukm');
    }
};
