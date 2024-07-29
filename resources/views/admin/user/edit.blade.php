@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit User</h2>

    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="status_id">Status</label>
            <select name="status_id" class="form-control">
                <option value="">Select Status</option>
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" {{ $user->status_id == $status->id ? 'selected' : '' }}>{{ $status->status_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
