@extends('layouts.master')

@section('title')
    Show Books
@endsection

@section('content')
<!-- Form Pencarian -->
<form action="{{ url('/books') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search books..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Search</button>
    </div>
</form>

@auth 
    @if (Auth()->user()->role === 'admin')
        <a href="/books/create" class="btn btn-primary my-3">Add</a>
    @endif
@endauth

<!-- Container untuk Card -->
<div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @forelse ($books as $item)
            <div class="col">
                <div class="card shadow-sm h-100" style="max-width: 100%;"> 
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="Book Image" 
                             style="width: 100%; height: 300px; object-fit: cover; border-radius: 5px;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                             style="width: 100%; height: 300px; object-fit: cover; border-radius: 5px;">
                            <span>No Image</span>
                        </div>
                    @endif
                    <div class="card-body p-2">
                        <h6 class="card-title">{{ $item->title }}</h6>
                        <p class="card-text text-muted" style="font-size: 14px;">{{ Str::limit($item->summary, 50) }}</p>
                        <p style="font-size: 13px;"><strong>Genre:</strong> {{ $item->genre->name ?? 'No Genre Available' }}</p>
                        
                        <div class="d-grid gap-2">
                            <a href="/books/{{$item->id}}" class="btn btn-info btn-sm">Read More</a>
                        </div>
                        
                        @auth
                        @if (Auth()->user()->role === 'admin')
                        <div class="row mt-2">
                            <div class="col">
                                <div class="d-grid gap-2">
                                    <a href="/books/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                            </div>
                            <div class="col">
                                <form action="/books/{{$item->id}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center w-100">No Books Available</p>
        @endforelse
    </div>
</div>


@endsection
