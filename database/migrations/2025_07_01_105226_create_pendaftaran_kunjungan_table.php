<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan'); // Contoh: Kunjungan, Magang, Penelitian
            $table->string('instansi'); // Nama sekolah atau lembaga
            $table->integer('dewasa')->default(1); // Jumlah peserta dewasa
            $table->integer('anak')->default(0); // Jumlah peserta anak
            $table->date('tanggal'); // Tanggal rencana kunjungan
            $table->string('status')->default('Menunggu Konfirmasi'); // Status pendaftaran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran_kunjungan');
    }
};
