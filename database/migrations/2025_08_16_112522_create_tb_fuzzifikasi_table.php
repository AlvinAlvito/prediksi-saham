<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_tb_fuzzifikasi_table.php
    public function up()
    {
        Schema::create('tb_fuzzifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saham_id')->constrained('sahams')->onDelete('cascade');

            $table->decimal('per_rendah', 5, 3)->nullable();
            $table->decimal('per_sedang', 5, 3)->nullable();
            $table->decimal('per_tinggi', 5, 3)->nullable();

            $table->decimal('roe_buruk', 5, 3)->nullable();
            $table->decimal('roe_cukup', 5, 3)->nullable();
            $table->decimal('roe_baik', 5, 3)->nullable();

            $table->decimal('volume_kecil', 5, 3)->nullable();
            $table->decimal('volume_sedang', 5, 3)->nullable();
            $table->decimal('volume_besar', 5, 3)->nullable();

            $table->decimal('kapitalis_kecil', 5, 3)->nullable();
            $table->decimal('kapitalis_sedang', 5, 3)->nullable();
            $table->decimal('kapitalis_besar', 5, 3)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_fuzzifikasi');
    }
};
