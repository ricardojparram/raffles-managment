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
        Schema::table('teams', function (Blueprint $table) {
            $table->string('runlot_number')->nullable()->after('slug');
        });

        Schema::table('raffles', function (Blueprint $table) {
            $table->string('conalot_permit')->nullable()->after('minimum_tickets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropColumn('conalot_permit');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('runlot_number');
        });
    }
};
