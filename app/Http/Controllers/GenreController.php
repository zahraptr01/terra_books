<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GenreController extends Controller
{
    // Menampilkan form tambah genre
    public function create()
    {
        return view('genres.create');
    }

    // Menyimpan genre baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:255',
            'description' => 'required|max:255',
        ]);

        // Insert data ke Database
        DB::table('genres')->insert([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // redirect
        return redirect('/genres');
    }

    // Menampilkan semua genre
    public function index(Request $request)
    {
        $query = DB::table('genres');

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $genres = $query->get();

        return view('genres.show', compact('genres'));
    }


    // Menampilkan detail genre tertentu
    public function show($id)
    {
        $genre = DB::table('genres')->where('id', $id)->first();
        
        if (!$genre) {
            return redirect('/genres')->with('error', 'Genre not found.');
        }

        // Ambil buku yang memiliki genre_id sesuai
        $books = DB::table('books')
            ->where('genre_id', $id)
            ->get();

        return view('genres.detail', compact('genre', 'books'));
    }


    // Menampilkan form edit genre
    public function edit($id)
    {
        $genres = DB::table('genres')->find($id);
        return view('genres.edit', ['genres' => $genres]);
    }

    // Update Genre
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:255',
            'description' => 'required|max:255',
        ]);

        // Update data ke Database
        DB::table('genres')
            ->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);

        // redirect
        return redirect('/genres');
    }

    // Menghapus genre
    public function destroy($id)
    {
        DB::table('genres')->where('id', $id)->delete();
        return redirect('/genres');
    }
}
