<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom kuota dan orang per paket ke tabel ticket_types.
     */
    public function up(): void
    {
        Schema::table('ticket_types', function (Blueprint $table) {
            $table->integer('quota')->default(0); // Jumlah total orang yang bisa membeli tiket ini
            $table->integer('people_per_package')->default(1); // Berapa orang per paket tiket (1 = Solo, 2 = Duo, dst.)
        });
    }

    /**
     * Menghapus kolom yang ditambahkan jika migrasi di-rollback.
     */
    public function down(): void
    {
        Schema::table('ticket_types', function (Blueprint $table) {
            $table->dropColumn(['quota', 'people_per_package']);
        });
    }
};
