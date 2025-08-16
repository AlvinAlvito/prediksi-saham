<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_sahams_table.php
    public function up()
    {
        Schema::create('sahams', function (Blueprint $table) {
            $table->id();
            $table->string('kode_saham', 10)->unique();
            $table->string('nama_saham', 100);
            $table->decimal('per', 10, 2);
            $table->decimal('roe', 10, 2);
            $table->bigInteger('volume');
            $table->decimal('market_cap', 15, 2);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sahams');
    }
};
