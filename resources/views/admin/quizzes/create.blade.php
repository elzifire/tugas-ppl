@extends('layouts.app')

@section('content')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

{{-- create form with card boostrap 5 --}}

<div class="card">
    <div class="card-header"><h5>Buat Kuis</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('quizzes.store') }}" enctype="multipart/form-data" id="uploadForm"> 
            @csrf

           
            <div class="mb-3">
                <label for="image" class="form-label">Gambar:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>


            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori:</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="question" class="form-label">Pertanyaan</label>
                <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
            </div>

            <div class="mb-3">
                <label for="option_a" class="form-label">Opsi A:</label>
                <input type="text" name="option_a" id="option_a" class="form-control" value="{{ old('option_a') }}" required>
            </div>

            <div class="mb-3">
                <label for="option_b" class="form-label">Opsi B:</label>
                <input type="text" name="option_b" id="option_b" class="form-control" value="{{ old('option_b') }}" required>
            </div>

            <div class="mb-3">
                <label for="option_c" class="form-label">Opsi C:</label>
                <input type="text" name="option_c" id="option_c" class="form-control" value="{{ old('option_c') }}" required>
            </div>

            <div class="mb-3">
                <label for="option_d" class="form-label">Opsi D:</label>
                <input type="text" name="option_d" id="option_d" class="form-control" value="{{ old('option_d') }}" required>
            </div>

            <div class="mb-3">
                <label for="correct_answer" class="form-label">Correct Answer:</label>
                <select name="correct_answer" id="correct_answer" class="form-select" required>
                    <option value="">Select Correct Answer</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create Quiz</button>
            </div>
        </form>

    </div>
</div>

<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        const imageInput = document.getElementById('image');
        if (!imageInput.files.length) {
            imageInput.value = null;
        }
    });
</script>

@endsection
