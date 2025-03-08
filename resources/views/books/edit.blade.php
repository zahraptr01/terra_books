@extends('layouts.master')

@section('title')
    Edit Book
@endsection

@section('content')
<form action="/books/{{$book->id}}" method="POST" enctype="multipart/form-data"> 
    @method("PUT")
    @csrf

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Book Title</label>
        <input type="text" name="title" value="{{$book->title}}" class="form-control"> 
    </div>
    <div class="mb-3">
        <label class="form-label">Summary</label>
        <textarea name="summary" class="form-control" cols="30" rows="10">{{$book->summary}}</textarea> 
    </div>
    <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" name="image" class="form-control">
        @if ($book->image)
            <div>
                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" style="max-width: 200px;">
            </div>
        @endif
    </div>
    <div class="mb-3">
        <label class="form-label">Stock</label>
        <input type="text" name="stok" value="{{$book->stok}}" class="form-control"> 
    </div>
    <div class="mb-3">
        <label class="form-label">Genre</label>
        <select name="genre_id" class="form-control">
            <option value="">-- Choose Genre --</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ $book->genre_id == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
            <option value="">-- No Genre Available--</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
