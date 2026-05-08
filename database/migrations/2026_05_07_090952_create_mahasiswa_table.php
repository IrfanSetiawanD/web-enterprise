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
        Schema::create('mahasiswa', function (Blueprint $table) {
            // Menggunakan id_mahasiswa sebagai Primary Key kustom
            $table->id('id_mahasiswa');

            // Kolom identitas mahasiswa
            $table->string('nim')->unique(); // Nomor Induk Mahasiswa (harus unik)
            $table->string('nama_mahasiswa');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Kolom kontak dan alamat
            $table->text('alamat');
            $table->string('no_hp');

            // Kolom otomatis created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
