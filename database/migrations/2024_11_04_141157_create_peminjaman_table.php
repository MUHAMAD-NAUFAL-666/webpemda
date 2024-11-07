<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_dokumen'); // buku tanah, surat ukur, warkah
            $table->string('nama_peminjam');
            $table->string('nomor_dokumen');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('status')->default('Dipinjam'); // Dipinjam, Dikembalikan
            $table->string('regency_id')->nullable(); // Kolom kecamatan
            $table->string('district_id')->nullable();
            $table->string('village_id')->nullable();
            $table->decimal('denda', 10, 2)->default(0)->after('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
