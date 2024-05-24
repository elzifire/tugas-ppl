<!-- resources/views/admin/barcodes/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generated Barcode</h1>
    <div>{!! $qrCode !!}</div>
    <p>Barcode: {{ $barcode->code }}</p>
    <p>Expires at: {{ $barcode->expires_at }}</p>
  <button onclick="print()">PRINT PDF</button>

</div>
@stop
