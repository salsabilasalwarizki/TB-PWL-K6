// database/migrations/xxxx_xx_xx_fix_all_dataset_pivot_tables.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('dataset_images', 'display_order')) {
            Schema::table('dataset_images', function (Blueprint $table) {
                $table->unsignedInteger('display_order')->default(0)->after('role');
            });
        }
        
        if (!Schema::hasColumn('dataset_files', 'display_order')) {
            Schema::table('dataset_files', function (Blueprint $table) {
                $table->unsignedInteger('display_order')->default(0)->after('is_default');
            });
        }
        
        if (!Schema::hasColumn('dataset_contributors', 'display_order')) {
            Schema::table('dataset_contributors', function (Blueprint $table) {
                $table->unsignedInteger('display_order')->default(0)->after('contribution_role');
            });
        }
    }

    public function down(): void
    {
        Schema::table('dataset_images', function (Blueprint $table) {
            $table->dropColumn('display_order');
        });
        
        Schema::table('dataset_files', function (Blueprint $table) {
            $table->dropColumn('display_order');
        });
        
        Schema::table('dataset_contributors', function (Blueprint $table) {
            $table->dropColumn('display_order');
        });
    }
};