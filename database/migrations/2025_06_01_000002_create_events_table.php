<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // EO
    $table->string('title');
    $table->text('description');
    $table->dateTime('event_date');
    $table->string('location');
    $table->integer('capacity');
    $table->decimal('price', 10, 2);
    $table->string('image')->nullable();
    $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
