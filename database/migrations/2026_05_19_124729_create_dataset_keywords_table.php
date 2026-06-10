<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
Schema::create('dataset_keywords', function (Blueprint $table) {
    $table->foreignId('dataset_id')->constrained('datasets', 'dataset_id')->onDelete('cascade');
    $table->foreignId('keyword_id')->constrained('keywords', 'keyword_id')->onDelete('cascade');
    $table->primary(['dataset_id', 'keyword_id']);
    $table->timestamps();
});
    }


    public function down(): void
    {
        Schema::dropIfExists('dataset_keywords');
    }
};
