@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <a href="{{ route('quizzes.create') }}" class="btn btn-primary">Tambah</a>
            <div class="card">
                <div class="card-header">Daftar Kuis</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Kategori</th>
                                <th>Pertanyaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $quiz->image }}" alt="" style="max-width: 100px">
                                </td>
                                <td>{{ $quiz->category->name }}</td>
                                <td>{{ $quiz->question }}</td>
                                <td>
                                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
                                        <a href="{{ route('quizzes.edit', $quiz->id ) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
