@extends('layouts.master')

@section('title')
    Edit Genre
@endsection

@section('content')
<form action="/genres/{{$genres->id}}" method="POST">
    @method("PUT")
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
        <label  class="form-label">Genre Name</label>
        <input type="text" name="name" value="{{$genres->name}}" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Genre Description</label>
        <textarea name="description" class="form-control" cols="30" rows="10">{{$genres->description}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
