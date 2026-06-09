<?php

// database/migrations/xxxx_xx_xx_add_is_public_to_datasets.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('datasets', function (Blueprint $table) {
            if (!Schema::hasColumn('datasets', 'is_public')) {
                $table->boolean('is_public')->default(false)->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('datasets', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });
    }
};