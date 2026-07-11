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
        Schema::table('raffles', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('img');
        });

        // Convert existing decimals to cents
        \Illuminate\Support\Facades\DB::statement('UPDATE raffles SET ticket_price = ticket_price * 100');
        \Illuminate\Support\Facades\DB::statement('UPDATE offers SET price = price * 100');

        Schema::table('raffles', function (Blueprint $table) {
            $table->integer('ticket_price')->change();
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->integer('price')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->decimal('ticket_price', 10, 2)->change();
        });

        Schema::table('offers', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE raffles SET ticket_price = ticket_price / 100');
        \Illuminate\Support\Facades\DB::statement('UPDATE offers SET price = price / 100');
    }
};
