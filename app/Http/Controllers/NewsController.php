<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    public function index()
    {
        $query = News::with(['author', 'category', 'editor']);

        // Filter based on user role
        if (auth()->user()->isWartawan()) {
            $query->where('author_id', auth()->id());
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('news.index', compact('news'));
    }

    public function create()
    {
        $this->authorize('create', News::class);
        $categories = Category::all();
        return view('news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', News::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['author_id'] = auth()->id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            // Create directory if not exists
            $path = public_path('images/news');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            
            // Resize and save image
            $img = Image::make($image)->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $img->save(public_path('images/news/' . $filename));
            $data['image'] = $filename;
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat dan menunggu persetujuan editor.');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $this->authorize('update', $news);
        $categories = Category::all();
        return view('news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $this->authorize('update', $news);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($news->image && file_exists(public_path('images/news/' . $news->image))) {
                unlink(public_path('images/news/' . $news->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            
            $img = Image::make($image)->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $img->save(public_path('images/news/' . $filename));
            $data['image'] = $filename;
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        $this->authorize('delete', $news);

        // Delete image
        if ($news->image && file_exists(public_path('images/news/' . $news->image))) {
            unlink(public_path('images/news/' . $news->image));
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }

    public function approve(News $news)
    {
        $this->authorize('approve', $news);

        $news->update([
            'status' => 'published',
            'editor_id' => auth()->id(),
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Berita berhasil dipublish.');
    }

    public function reject(News $news)
    {
        $this->authorize('approve', $news);

        $news->update([
            'status' => 'rejected',
            'editor_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Berita ditolak.');
    }
}