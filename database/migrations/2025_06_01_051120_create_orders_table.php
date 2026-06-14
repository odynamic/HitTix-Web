<?php

// database/migrations/2025_06_05_000002_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');   // pembeli tiket
    $table->unsignedBigInteger('event_id');  // event yang dibeli
    $table->integer('quantity');             // jumlah tiket
    $table->decimal('total_price', 10, 2);   // total harga
    $table->string('payment_status');        // 'pending', 'paid', 'failed'
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
