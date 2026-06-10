<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::table('datasets', function(Blueprint $table) {
    $table->foreignId('task_id')->nullable()->constrained('tasks', 'task_id')->nullOnDelete();
    $table->foreignId('subject_area_id')->nullable()->constrained('subject_areas', 'area_id')->nullOnDelete();
});
    }

    public function down(): void
    {
        Schema::table('datasets', function (Blueprint $table) {
            //
        });
    }
};
