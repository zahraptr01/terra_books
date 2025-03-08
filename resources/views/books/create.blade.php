@extends('layouts.master')

@section('title')
    Add Books
@endsection

@section('content')
<!-- <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data"> -->
<form action="/books" method="POST" enctype="multipart/form-data">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
    @csrf
        <div class="mb-3">
            <label  class="form-label">Book Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Summary</label>
            <textarea name="summary" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image">
        </div>
        <div class="mb-3">
            <label  class="form-label">Stok</label>
            <input type="text" name="stok" class="form-control">
        </div>
        <div class="mb-3">
            <label  class="form-label">Genre</label>
            <select name="genre_id" id="" class="form-control">
                <option value="">-- Choose Genre --</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
                <option value="">-- No Genre Available --</option>
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
</form>
@endsection
