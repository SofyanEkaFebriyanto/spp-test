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
            $table->foreignId('id_petugas')->constrained('users')->onDelete('cascade');
            $table->string('nisn', 10);
            $table->foreign('nisn')->references('nisn')->on('siswas')->onDelete('cascade');
            $table->date('tgl_bayar');
            $table->string('bulan_dibayar', 20);
            $table->string('tahun_dibayar', 4);
            $table->foreignId('id_spp')->constrained('spps')->onDelete('cascade');
            $table->integer('jumlah_bayar');
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
