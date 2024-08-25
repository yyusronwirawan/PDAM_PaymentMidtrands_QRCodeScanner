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
        Schema::create('pemakaians', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('penggunaan_awal');
            $table->bigInteger('penggunaan_akhir');
            $table->bigInteger('jumlah_penggunaan');
            $table->bigInteger('jumlah_pembayaran')->nullable();
            $table->date('batas_bayar');
            $table->foreignId('user_id');
            $table->foreignId('periode_id');
            $table->enum('status', ['belum dibayar', 'lunas'])->default('belum dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaians');
    }
};
