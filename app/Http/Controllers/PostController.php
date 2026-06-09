<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of posts with search, filter, and sort
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'category']);

        // Search by title or body
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by author
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Sort
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');
        $allowedSorts = ['created_at', 'title', 'view_count', 'published_at'];
        
        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $order === 'asc' ? 'asc' : 'desc');
        } else {
            $query->latest();
        }

        $posts = $query->paginate(10)->withQueryString();

        // Stats untuk dashboard
        $stats = [
            'total' => Post::count(),
            'published' => Post::where('status', 'published')->count(),
            'draft' => Post::where('status', 'draft')->count(),
            'archived' => Post::where('status', 'archived')->count(),
            'total_views' => Post::sum('view_count'),
        ];

        $categories = Category::where('active', 1)->orderBy('name')->get();

        return view('admin.posts.index', compact('posts', 'stats', 'categories'));
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        $categories = Category::where('active', 1)->orderBy('name')->get();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string|min:10',
            'excerpt' => 'nullable|string|max:500',
            'featured_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Judul wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'body.required' => 'Konten wajib diisi',
            'body.min' => 'Konten minimal 10 karakter',
            'category_id.required' => 'Kategori wajib dipilih',
            'category_id.exists' => 'Kategori tidak valid',
            'featured_img.image' => 'File harus berupa gambar',
            'featured_img.mimes' => 'Format gambar: jpg, jpeg, png, webp',
            'featured_img.max' => 'Ukuran gambar maksimal 5MB',
        ]);

        // Generate unique slug
        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        // Auto-generate excerpt jika kosong
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['body']), 160);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_img')) {
            $validated['featured_img'] = $request->file('featured_img')->store('posts', 'public');
        }

        // Set user_id dari user yang login
        $validated['user_id'] = Auth::id();

        // Set published_at otomatis jika status published
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Reset published_at jika status bukan published
        if ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dibuat!');
    }

    /**
     * Display the specified post
     */
    public function show(Post $post)
    {
        $post->load(['user', 'category']);
        
        // Get related posts
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified post
     */
    public function edit(Post $post)
    {
        $categories = Category::where('active', 1)->orderBy('name')->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string|min:10',
            'excerpt' => 'nullable|string|max:500',
            'featured_img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Judul wajib diisi',
            'body.required' => 'Konten wajib diisi',
            'body.min' => 'Konten minimal 10 karakter',
            'category_id.required' => 'Kategori wajib dipilih',
        ]);

        // Update slug jika title berubah
        if ($validated['title'] !== $post->title) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title'], $post->id);
        }

        // Auto-generate excerpt jika kosong
        if (empty($validated['excerpt'])) {
            $validated['excerpt'] = Str::limit(strip_tags($validated['body']), 160);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_img')) {
            // Delete old image
            if ($post->featured_img) {
                Storage::disk('public')->delete($post->featured_img);
            }
            $validated['featured_img'] = $request->file('featured_img')->store('posts', 'public');
        }

        // Set published_at otomatis jika status berubah ke published
        if ($validated['status'] === 'published' && $post->status !== 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Reset published_at jika status bukan published
        if ($validated['status'] !== 'published') {
            $validated['published_at'] = null;
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil diupdate!');
    }

    /**
     * Remove the specified post
     */
    public function destroy(Post $post)
    {
        // Delete featured image
        if ($post->featured_img) {
            Storage::disk('public')->delete($post->featured_img);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post berhasil dihapus!');
    }

    /**
     * Bulk delete multiple posts
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'post_ids' => 'required|array|min:1',
            'post_ids.*' => 'exists:posts,id',
        ]);

        $posts = Post::whereIn('id', $request->post_ids)->get();

        // Delete all featured images
        foreach ($posts as $post) {
            if ($post->featured_img) {
                Storage::disk('public')->delete($post->featured_img);
            }
        }

        // Delete posts
        Post::whereIn('id', $request->post_ids)->delete();

        return back()->with('success', count($request->post_ids) . ' post(s) berhasil dihapus!');
    }

    /**
     * Toggle post status (publish/unpublish)
     */
    public function toggleStatus(Post $post)
    {
        if ($post->status === 'published') {
            $post->update([
                'status' => 'draft',
                'published_at' => null,
            ]);
            $message = 'Post berhasil di-unpublish!';
        } else {
            $post->update([
                'status' => 'published',
                'published_at' => $post->published_at ?? now(),
            ]);
            $message = 'Post berhasil dipublish!';
        }

        return back()->with('success', $message);
    }

    /**
     * Duplicate a post
     */
    public function duplicate(Post $post)
    {
        $newPost = $post->replicate();
        $newPost->title = $post->title . ' (Copy)';
        $newPost->slug = $this->generateUniqueSlug($newPost->title);
        $newPost->status = 'draft';
        $newPost->published_at = null;
        $newPost->view_count = 0;
        $newPost->user_id = Auth::id();
        $newPost->save();

        // Copy featured image if exists
        if ($post->featured_img && Storage::disk('public')->exists($post->featured_img)) {
            $extension = pathinfo($post->featured_img, PATHINFO_EXTENSION);
            $newPath = 'posts/' . Str::uuid() . '.' . $extension;
            Storage::disk('public')->copy($post->featured_img, $newPath);
            $newPost->featured_img = $newPath;
            $newPost->save();
        }

        return redirect()->route('admin.posts.edit', $newPost)
            ->with('success', 'Post berhasil diduplikasi! Silakan edit konten baru.');
    }

    /**
     * Generate unique slug from title
     */
    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        $query = Post::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $query = Post::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
            $counter++;
        }

        return $slug;
    }

    /**
     * Get posts statistics (untuk dashboard)
     */
    public function stats()
    {
        return response()->json([
            'total' => Post::count(),
            'published' => Post::where('status', 'published')->count(),
            'draft' => Post::where('status', 'draft')->count(),
            'archived' => Post::where('status', 'archived')->count(),
            'total_views' => Post::sum('view_count'),
            'latest_posts' => Post::latest()->take(5)->get(['id', 'title', 'status', 'created_at']),
        ]);
    }
}