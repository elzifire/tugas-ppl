@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Barcodes List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>User</th>
                <th>Expires At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barcodes as $barcode)
            <tr>
                <td>{{ $barcode->id }}</td>
                <td>{{ $barcode->code }}</td>
                <td>{{ $barcode->user->name }}</td>
                <td>{{ $barcode->expires_at }}</td>
                <td><a href="{{ route('admin.barcodes.show', $barcode->id) }}">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
