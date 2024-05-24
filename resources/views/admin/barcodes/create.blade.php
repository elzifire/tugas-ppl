<!-- resources/views/admin/barcodes/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generate Barcode</h1>
    <form action="{{ route('admin.barcodes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">User:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="expires_at">Expiration Date:</label>
            <input type="date" name="expires_at" id="expires_at" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Barcode</button>
    </form>
</div>
@endsection
