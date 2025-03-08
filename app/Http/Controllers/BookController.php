<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Middleware\IsAdmin;

class BookController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', IsAdmin::class], except: ['index', 'show']),
        ];
    }

    // Menampilkan semua buku
    public function index(Request $request)
    {
        $query = Book::with('genre'); // Load relasi genre

        if ($request->has('search') && !empty($request->search)) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('summary', 'LIKE', '%' . $request->search . '%')
                ->orWhereHas('genre', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->search . '%');
                });
        }

        $books = $query->get();
        return view('books.show', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        $genres = Genre::all();
        return view('books.create', compact('genres'));
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required',
            'stok' => 'required|integer|min:0',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        }

        Book::create([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'stok' => $validated['stok'],
            'genre_id' => $validated['genre_id'],
            'image' => $imagePath,
        ]);

        return redirect('/books')->with('success', 'Book added successfully.');
    }

    // Menampilkan detail buku tertentu
    public function show($id)
    {
        $book = Book::with(['genre', 'comments.user'])->findOrFail($id);
        return view('books.detail', compact('book'));
    }

    // Menyimpan komentar
    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'book_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment successfully added.');
    }

    // Menampilkan form edit buku
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $genres = Genre::all();
        return view('books.edit', compact('book', 'genres'));
    }

    // Mengupdate data buku
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required',
            'stok' => 'required|integer|min:0',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $book = Book::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->update([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'stok' => $validated['stok'],
            'genre_id' => $validated['genre_id'],
            'image' => $book->image,
        ]);

        return redirect('/books')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();
        return redirect('/books')->with('success', 'Buku berhasil dihapus.');
    }
}
