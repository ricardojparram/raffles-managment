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
            $table->string('winning_number')->nullable()->after('ticket_amount');
        });

        Schema::table('raffle_prizes', function (Blueprint $table) {
            $table->string('winning_number')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn('winning_number');
        });

        Schema::table('raffle_prizes', function (Blueprint $table) {
            $table->dropColumn('winning_number');
        });
    }
};
