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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->timestamp('date');
            $table->string('img')->nullable();
            $table->decimal('ticket_price', 10, 2);
            $table->text('description');
            $table->enum('status', ['active', 'canceled', 'finished', 'pending'])->default('pending');
            $table->integer('ticket_amount')->default(100);
            $table->integer('minimum_tickets')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
