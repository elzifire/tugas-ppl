@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <!-- Filter by category -->
            <div class="card mb-4">
                <div class="card-body">
                    
                    <form method="GET" action="{{ route('quizzes.index') }}" class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="category_id" class="col-form-label">Filter by Category</label>
                        </div>
                        <div class="col-auto">
                            <select id="category_id" name="category_id" class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Daftar Kuis</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
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
                                    <img src="{{ $quiz->image }}" alt="Quiz Image" style="max-width: 100px" class="img-thumbnail">
                                </td>
                                <td>{{ $quiz->category->name }}</td>
                                <td>{{ $quiz->question }}</td>
                                <td>
                                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="d-inline">
                                        <a href="{{ route('quizzes.edit', $quiz->id ) }}" class="btn btn-sm btn-warning">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            {{-- pagination --}}
                            <tr>
                                
                            </tr>
                        </tfoot>
                    </table>
                    <!-- Tambahkan pesan jika tidak ada kuis yang ditemukan -->
                    @if($quizzes->isEmpty())
                        <div class="alert alert-warning mt-3" role="alert">
                            No quizzes found for the selected category.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
           
        </div>
    </div>
</div>
@endsection
