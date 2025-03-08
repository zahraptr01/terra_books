@extends('layouts.master')

@section('title')
    Detail Genre
@endsection

@section('content')
    <h1 class="mb-3">{{ $genre->name }}</h1>
    <p><strong>Description:</strong> {{$genre->description}}</p>

    @if ($books->isEmpty())
        <p>No books available in this genre.</p>
    @else
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($book->image)
                            <img src="{{ asset($book->image) }}" class="card-img-top" alt="Book Image" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                <span>No Image</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($book->summary, 80) }}</p>
                            <div class="d-grid gap-2">
                                <a href="{{ url('/books/' . $book->id) }}" class="btn btn-info btn-sm">Read More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
