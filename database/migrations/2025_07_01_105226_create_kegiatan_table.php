<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->string('nama_kegiatan', 255);
            $table->text('deskripsi_kegiatan');
            
            // Jadwal & Lokasi
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable(); // Bisa saja acara hanya 1 hari (maka sama dengan mulai)
            $table->string('lokasi_kegiatan', 150)->nullable(); // Misal: Auditorium A, Ruang Pameran Utama
            
            // Status dan Penanggung Jawab
            $table->enum('status', ['Akan Datang', 'Sedang Berlangsung', 'Selesai'])->default('Akan Datang');
            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};