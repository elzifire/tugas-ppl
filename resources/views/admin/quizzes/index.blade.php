<!-- resources/views/admin/quizzes/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Kuis</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Tambah Kuis</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>ID</th>
                                <th>Kategori</th>
                                <th>Pertanyaan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)
                                    <tr>
                                        <td>{{ $quiz->id }}</td>
                                        <td>{{ $quiz->category->name }}</td>
                                        <td>{{ $quiz->question }}</td>
                                        <td>
                                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-primary">Detail</a>
                                            <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-success">Edit</a>
                                            <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kuis ini?')">Hapus</button>
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
