@extends('layouts.app')

@section('content')

<form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="form-group">
        <label class="font-weight-bold">GAMBAR</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
    
        <!-- error message untuk title -->
        @error('image')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button type="submit" class="btn btn-md btn-primary mt-3">SIMPAN</button>
</form>

@endsection