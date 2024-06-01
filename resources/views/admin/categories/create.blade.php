<!-- resources/views/admin/categories/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kategori Kuis</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama kategori">
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
