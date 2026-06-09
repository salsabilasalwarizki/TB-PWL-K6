<?php

// database/migrations/xxxx_xx_xx_add_is_default_to_dataset_files.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dataset_files', function (Blueprint $table) {
            if (!Schema::hasColumn('dataset_files', 'is_default')) {
                $table->boolean('is_default')->default(false)->after('file_role');
            }
            if (!Schema::hasColumn('dataset_files', 'display_order')) {
                $table->integer('display_order')->default(0)->after('is_default');
            }
        });
    }

    public function down(): void
    {
        Schema::table('dataset_files', function (Blueprint $table) {
            $table->dropColumn(['is_default', 'display_order']);
        });
    }
};