<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('user_saved_datasets', function (Blueprint $table) {
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('dataset_id')->constrained('datasets', 'dataset_id')->onDelete('cascade');
    $table->timestamp('saved_at')->useCurrent();
    $table->primary(['user_id', 'dataset_id']);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('user_saved_datasets');
    }
};
