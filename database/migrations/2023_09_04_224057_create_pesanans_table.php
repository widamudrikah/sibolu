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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('masyarakat_id')->nullable();
            $table->integer('pengantar_id')->nullable();
            $table->integer('produk_id')->nullable();
            $table->string('kode')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('jumlah')->nullable();
            $table->integer('harga_total')->nullable();
            $table->integer('ongkir')->nullable();
            $table->string('kota')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pembayaran')->nullable();
            $table->string('bukti')->nullable();
            $table->string('status_bayar')->nullable();
            $table->string('status_pesanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
