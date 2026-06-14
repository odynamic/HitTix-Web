<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
            Schema::table('payments', function (Blueprint $table) {
        if (!Schema::hasColumn('payments', 'user_id')) {
            $table->unsignedBigInteger('user_id')->after('id');
        }

        if (!Schema::hasColumn('payments', 'order_id')) {
            $table->string('order_id')->nullable()->after('user_id');
        }

        if (!Schema::hasColumn('payments', 'gross_amount')) {
            $table->integer('gross_amount')->nullable()->after('order_id');
        }

        if (!Schema::hasColumn('payments', 'status')) {
            $table->string('status')->default('pending')->after('gross_amount');
        }

        if (!Schema::hasColumn('payments', 'payment_type')) {
            $table->string('payment_type')->nullable()->after('status');
        }

        if (!Schema::hasColumn('payments', 'pdf_url')) {
            $table->string('pdf_url')->nullable()->after('payment_type');
        }
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'order_id', 'gross_amount', 'status']);
        });
    }
};
