<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_hasil_fuzzy_table.php
    public function up()
    {
        Schema::create('hasil_fuzzy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saham_id')->constrained('sahams')->onDelete('cascade');
            $table->foreignId('fuzzifikasi_id')->constrained('tb_fuzzifikasi')->onDelete('cascade');

            $table->decimal('nilai_z', 8, 3);
            $table->decimal('persentase', 6, 2);
            $table->string('kategori', 50);
            $table->text('interpretasi')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_fuzzy');
    }
};
