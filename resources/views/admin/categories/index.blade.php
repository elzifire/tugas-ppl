<!-- resources/views/admin/categories/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Kategori Kuis</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">Tambah Kategori</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Detail</a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
