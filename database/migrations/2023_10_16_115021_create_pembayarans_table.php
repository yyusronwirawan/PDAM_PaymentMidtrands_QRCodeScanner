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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_pembayaran')->unique();
            $table->string('tgl_bayar');
            $table->double('uang_cash');
            $table->double('kembalian');
            $table->double('denda');
            $table->double('subTotal');
            $table->uuid('pemakaian_id');
            $table->foreign('pemakaian_id')->references('id')->on('pemakaians');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
