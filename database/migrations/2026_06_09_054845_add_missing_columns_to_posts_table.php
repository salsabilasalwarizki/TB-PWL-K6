<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Tambah kolom slug jika belum ada
            if (!Schema::hasColumn('posts', 'slug')) {
                $table->string('slug')->unique()->after('title');
            }
            
            // Tambah kolom excerpt jika belum ada
            if (!Schema::hasColumn('posts', 'excerpt')) {
                $table->text('excerpt')->nullable()->after('body');
            }
            
            // Tambah kolom status jika belum ada
            if (!Schema::hasColumn('posts', 'status')) {
                $table->enum('status', ['draft', 'published', 'archived'])
                      ->default('draft')
                      ->after('category_id');
            }
            
            // Tambah kolom published_at jika belum ada
            if (!Schema::hasColumn('posts', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status');
            }
            
            // Tambah kolom view_count jika belum ada
            if (!Schema::hasColumn('posts', 'view_count')) {
                $table->integer('view_count')->default(0)->after('published_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['slug', 'excerpt', 'status', 'published_at', 'view_count']);
        });
    }
};