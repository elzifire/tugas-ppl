@extends('layouts.app')

@section('content')

    <div class="container">
     <div class="card">
          <div class="card-header">
                <h1>Edit Reward</h1>
          </div>
          <div class="card-body">
                <form action="{{ route('admin.rewards.update', $reward->id) }}" method="POST" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
                 <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ $reward->name }}">
                 </div>
                 <div class="mb-3">
                      <label for="point" class="form-label">Point</label>
                      <input type="number" class="form-control" id="point" name="point" value="{{ $reward->point }}">
                 </div>
                 <div class="mb-3">
                      <label for="stock" class="form-label">Stock</label>
                      <input type="number" class="form-control" id="stock" name="stock" value="{{ $reward->stock }}">
                 </div>
                 <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea class="form-control" id="description" name="description" rows="3">{{ $reward->description }}</textarea>
                 </div>
                 <div class="mb-3">
                      <label for="image" class="form-label">Image</label>
                        <img src="{{ $reward->image }}" alt="" style="width: 100px;">
                        <input type="file" class="form-control" id="image" name="image">
                 </div>
                 <button type="submit" class="btn btn-primary">Submit</button>
                </form>
          </div>
     </div>
    </div>

@endsection