<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama kategori (Musik, Stand Up Comedy, dll)
            $table->string('slug')->unique(); // URL friendly name
            $table->text('description')->nullable(); // Deskripsi kategori
            $table->string('image')->nullable(); // Gambar kategori
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};