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
        Schema::table('refferal_rewards', function (Blueprint $table) {
            $table->unsignedBigInteger('referrer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('refferal_rewards', function (Blueprint $table) {
            $table->dropColumn('referrer_id');
        });
    }
};
