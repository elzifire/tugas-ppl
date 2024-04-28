<!-- resources/views/admin/quizzes/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kuis</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('quizzes.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="Masukkan pertanyaan">
                        </div>
                        <div class="form-group">
                            <label for="option_a">Opsi A</label>
                            <input type="text" class="form-control" id="option_a" name="option_a" placeholder="Masukkan opsi A">
                        </div>
                        <div class="form-group">
                            <label for="option_b">Opsi B</label>
                            <input type="text" class="form-control" id="option_b" name="option_b" placeholder="Masukkan opsi B">
                        </div>
                        <div class="form-group">
                            <label for="option_c">Opsi C</label>
                            <input type="text" class="form-control" id="option_c" name="option_c" placeholder="Masukkan opsi C">
                        </div>
                        <div class="form-group">
                            <label for="option_d">Opsi D</label>
                            <input type="text" class="form-control" id="option_d" name="option_d" placeholder="Masukkan opsi D">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Jawaban Benar</label>
                            <select class="form-control" id="correct_answer" name="correct_answer">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
