@extends('layouts.app')

@section('content')
{{-- read data barcode with boostrap 5 --}}
    <div class="container">
        <div class="card">
            <div class="card-title">
                <h1 class="text-center">Barcode</h1>
                <a href="{{ route('admin.barcodes.create') }}" class="btn btn-primary mx-5">Buat Barcode</a>
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Expired At</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Cetak Barcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barcodes as $barcode)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $barcode->code }}</td>
                                <td>{{ $barcode->expires_at }}</td>
                                <td>{{ $barcode->created_at }}</td>
                                <td>{{ $barcode->updated_at }}</td>
                                <td>
                                    <a href="{{ route('admin.barcodes.show', $barcode->id) }}" class="btn btn-primary">Cetak</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
