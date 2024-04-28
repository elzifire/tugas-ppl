@extends('layouts.app')

@section('content')

<div class="container">
    
    <a href="{{ route('images.create') }}" class="btn btn-md btn-success mb-3">Tambah data</a>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td><img src="{{ $image->image }}" alt="Image" style="max-width: 100px;" class="img-fluid"></td>
                    <td>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"  action="{{ route('images.destroy', $image->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
