<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('package')->nullable(); // ex: '7_days', '30_days'
            $table->dateTime('active_until')->nullable(); // ex: sampai kapan tayang
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['package', 'active_until']);
        });
    }
};
