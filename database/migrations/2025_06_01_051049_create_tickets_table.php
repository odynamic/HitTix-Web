<?php

// database/migrations/2025_06_05_000001_create_tickets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('event_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('price', 12, 2);
    $table->unsignedInteger('quantity');
    $table->unsignedInteger('sold')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
