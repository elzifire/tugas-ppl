<!-- resources/views/admin/quizzes/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Kuis</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">FOTO</label>
                            <input type="file" class="form-control" name="image" value="{{ $quiz->image }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($quiz->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question">Pertanyaan</label>
                            <input type="text" class="form-control" id="question" name="question" value="{{ $quiz->question }}">
                        </div>
                        <div class="form-group">
                            <label for="option_a">Opsi A</label>
                            <input type="text" class="form-control" id="option_a" name="option_a" value="{{ $quiz->option_a }}">
                        </div>
                        <div class="form-group">
                            <label for="option_b">Opsi B</label>
                            <input type="text" class="form-control" id="option_b" name="option_b" value="{{ $quiz->option_b }}">
                        </div>
                        <div class="form-group">
                            <label for="option_c">Opsi C</label>
                            <input type="text" class="form-control" id="option_c" name="option_c" value="{{ $quiz->option_c }}">
                        </div>
                        <div class="form-group">
                            <label for="option_d">Opsi D</label>
                            <input type="text" class="form-control" id="option_d" name="option_d" value="{{ $quiz->option_d }}">
                        </div>
                        <div class="form-group">
                            <label for="correct_answer">Jawaban Benar</label>
                            <select class="form-control" id="correct_answer" name="correct_answer">
                                <option value="A" @if ($quiz->correct_answer == 'A') selected @endif>A</option>
                                <option value="B" @if ($quiz->correct_answer == 'B') selected @endif>B</option>
                                <option value="C" @if ($quiz->correct_answer == 'C') selected @endif>C</option>
                                <option value="D" @if ($quiz->correct_answer == 'D') selected @endif>D</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
