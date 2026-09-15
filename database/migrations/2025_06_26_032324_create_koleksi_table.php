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
        Schema::create('koleksi', function (Blueprint $table) {
            $table->id('id_koleksi');
            
            // Data Utama Item
            $table->string('kode_inventaris', 30)->unique(); // Kode unik item (misal: MU.2023.001)
            $table->string('nama_item', 255);
            $table->text('deskripsi')->nullable();
            
            // Foreign Key
           // dalam file migrasi create_koleksi_table.php
            $table->foreignId('id_kategori')
                ->nullable() // <-- Pastikan kolom ini bisa NULL
                ->constrained('kategori', 'id_kategori')
                ->onDelete('set null'); // <-- Ubah ini
            
            // Data Lokasi & Media
            $table->string('gambar', 255)->nullable(); // Menyimpan path file gambar utama
            
            // Data Kontekstual & Sejarah
            $table->date('tanggal_akuisisi')->nullable();
            $table->text('narasi_sejarah')->nullable(); // Narasi/cerita detail benda
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksi');
    }
};