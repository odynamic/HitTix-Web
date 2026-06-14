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
        Schema::table('users', function (Blueprint $table) {
                $table->string('username')->unique()->after('name');
                $table->string('phone')->nullable()->after('email');
                $table->date('birthdate')->nullable()->after('phone');
                $table->string('profile_picture')->nullable()->after('birthdate');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['username', 'phone', 'birthdate', 'profile_picture']);
    });    }
};
