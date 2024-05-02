@extends('layouts.app')

@section('content')
<h1>Create New Quiz</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('quizzes.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="image">Image (Optional):</label>
        <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/jpg,image/gif">
    </div>

    <div class="form-group">
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="question">Question:</label>
        <input type="text" name="question" id="question" class="form-control" value="{{ old('question') }}" required>
    </div>

    <div class="form-group">
        <label for="option_a">Option A:</label>
        <input type="text" name="option_a" id="option_a" class="form-control" value="{{ old('option_a') }}" required>
    </div>

    <div class="form-group">
        <label for="option_b">Option B:</label>
        <input type="text" name="option_b" id="option_b" class="form-control" value="{{ old('option_b') }}" required>
    </div>

    <div class="form-group">
        <label for="option_c">Option C:</label>
        <input type="text" name="option_c" id="option_c" class="form-control" value="{{ old('option_c') }}" required>
    </div>

    <div class="form-group">
        <label for="option_d">Option D:</label>
        <input type="text" name="option_d" id="option_d" class="form-control" value="{{ old('option_d') }}" required>
    </div>

    <div class="form-group">
        <label for="correct_answer">Correct Answer:</label>
        <select name="correct_answer" id="correct_answer" class="form-control" required>
            <option value="">Select Correct Answer</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Create Quiz</button>
    </div>
</form>

@endsection
