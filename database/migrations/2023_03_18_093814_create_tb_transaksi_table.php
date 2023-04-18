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
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('tb_user');
            $table->text('kode_transaksi');
            $table->string('nama_pembeli', 100);
            $table->string('no_wa_pembeli', 30);
            $table->text('alamat_pembeli');
            $table->integer('total_pembelian');
            $table->integer('total_harga');
            $table->text('tipe_pembayaran', 30);
            $table->integer('status');
            $table->integer('status_pengembalian')->nullable();
            $table->text('keterangan')->nullable();
            $table->dateTime('tanggal_transaksi');
            $table->date('tanggal_penerimaan')->nullable();
            $table->text('bukti_pembayaran')->nullable();
            $table->text('bukti_penerima')->nullable();
            $table->text('bukti_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};
