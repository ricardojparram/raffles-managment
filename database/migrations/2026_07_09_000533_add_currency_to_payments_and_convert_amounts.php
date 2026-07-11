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
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('description');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->string('currency', 3)->default('USD')->after('amount');
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE payments SET amount = amount * 100');

        Schema::table('payments', function (Blueprint $table) {
            $table->integer('amount')->change();
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('currency');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->decimal('amount', 10, 2)->change();
        });

        \Illuminate\Support\Facades\DB::statement('UPDATE payments SET amount = amount / 100');
    }
};
