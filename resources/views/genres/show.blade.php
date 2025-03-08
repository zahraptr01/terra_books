@extends('layouts.master')

@section('title')
    Show Genre
@endsection

@section('content')
<!-- Form Pencarian -->
<form action="{{ url('/genres') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search genres..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Search</button>
    </div>
</form>

@auth
  @if (Auth()->user()->role === 'admin')
    <a href="/genres/create" class="btn btn-primary my-3">Add</a>
  @endif
@endauth

<div class="row">
    @forelse ($genres as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p>{{ $item->description }}</p>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="/genres/{{$item->id}}" class="btn btn-info btn-sm">Detail</a>
                        @auth
                        @if (Auth()->user()->role === 'admin')
                        <div>
                            <a href="/genres/{{$item->id}}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <form action="/genres/{{$item->id}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>No Genre Available</p>
        </div>
    @endforelse
</div>
@endsection
