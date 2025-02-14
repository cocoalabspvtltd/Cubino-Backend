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
        Schema::table('bookings', function (Blueprint $table) {
            $table->boolean('is_checked_in')->default(false)->after('status');
            $table->boolean('is_checked_out')->default(false)->after('is_checked_in');
            $table->timestamp('checked_in_at')->nullable()->after('is_checked_out');
            $table->timestamp('checked_out_at')->nullable()->after('checked_in_at');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('is_checked_in');
            $table->dropColumn('is_checked_out');
            $table->dropColumn('checked_in_at');
            $table->dropColumn('checked_out_at');
        });
    }
};
