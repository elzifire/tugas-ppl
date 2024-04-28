<!-- resources/views/admin/categories/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Kategori Kuis</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="created_at">Dibuat pada</label>
                        <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $category->created_at }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="updated_at">Diperbarui pada</label>
                        <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $category->updated_at }}" readonly>
                    </div>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
