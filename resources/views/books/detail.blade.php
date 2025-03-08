@extends('layouts.master')

@section('title')
    Detail Book
@endsection

@section('content')

<h1 class="text-primary">{{$book->title}}</h1> 
@if ($book->image)
    <div>
        <img src="{{ asset($book->image) }}" alt="Book Image" style="max-width: 200px;">
    </div>
@else
    <p>No Image Available</p>
@endif
<br>
<p><strong>Book ID:</strong> {{$book->id}}</p>
<p><strong>Summary:</strong> {{$book->summary}}</p> 
<p><strong>Stock:</strong> {{$book->stok}}</p> 
<p><strong>Genre:</strong> {{ $book->genre->name ?? 'No Genre Available' }}</p>

<hr>

<!-- Menampilkan Komentar -->
<h4>Comments</h4>
@if ($book->comments->count() > 0)
    @foreach ($book->comments as $comment)
        <div class="border p-2 my-2">
            <p><strong>{{ $comment->user->name }}</strong> - <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
            <p>{{ $comment->content }}</p>
        </div>
    @endforeach
@else
    <p>No comments yet.</p>
@endif


<!-- Form Tambah Komentar -->
@auth
<form action="{{ route('books.comment', $book->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <textarea name="content" class="form-control" rows="3" placeholder="Write a comment..." required></textarea>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </div>
    
</form>
@else
<p><a href="{{ route('login') }}">Login</a> to write a comment.</p>
@endauth

<a href="/books" class="btn btn-secondary btn-sm">Back</a>

@endsection
