<!-- resources/views/admin/quizzes/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Kuis</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ $quiz->category->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="question">Pertanyaan</label>
                        <input type="text" class="form-control" id="question" name="question" value="{{ $quiz->question }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="option_a">Opsi A</label>
                        <input type="text" class="form-control" id="option_a" name="option_a" value="{{ $quiz->option_a }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="option_b">Opsi B</label>
                        <input type="text" class="form-control" id="option_b" name="option_b" value="{{ $quiz->option_b }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="option_c">Opsi C</label>
                        <input type="text" class="form-control" id="option_c" name="option_c" value="{{ $quiz->option_c }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="option_d">Opsi D</label>
                        <input type="text" class="form-control" id="option_d" name="option_d" value="{{ $quiz->option_d }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="correct_answer">Jawaban Benar</label>
                        <input type="text" class="form-control" id="correct_answer" name="correct_answer" value="{{ $quiz->correct_answer }}" readonly>
                    </div>
                    <a href="{{ route('quizzes.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
