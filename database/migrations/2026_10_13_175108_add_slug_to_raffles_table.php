<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        $usedSlugs = [];

        DB::table('raffles')->orderBy('id')->each(function (object $raffle) use (&$usedSlugs): void {
            $base = Str::limit(Str::slug($raffle->title) ?: 'rifa', 60, '');
            $slug = $base;
            $suffix = 1;

            while (isset($usedSlugs[$raffle->team_id][$slug])) {
                $slug = $base.'-'.$suffix++;
            }

            $usedSlugs[$raffle->team_id][$slug] = true;

            DB::table('raffles')->where('id', $raffle->id)->update(['slug' => $slug]);
        });

        Schema::table('raffles', function (Blueprint $table) {
            $table->unique(['team_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffles', function (Blueprint $table) {
            $table->dropUnique(['team_id', 'slug']);
            $table->dropColumn('slug');
        });
    }
};
