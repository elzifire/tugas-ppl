<!-- resources/views/admin/barcodes/create.blade.php -->
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-title">
                <h1 class="text-center">Buat Barcode</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.barcodes.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="expires_at" class="form-label">Expired At</label>
                        <input type="date" class="form-control" id="expires_at" name="expires_at">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


@endsection
