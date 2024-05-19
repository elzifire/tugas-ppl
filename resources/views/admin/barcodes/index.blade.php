@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($barcodes as $barcode)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{ $barcode->name }}
                        </div>
                        <div class="card-body">
                            <p>{{ $barcode->barcode }}</p>
                            <div>{!! DNS2D::getBarcodeHTML($barcode->barcode, 'QRCODE') !!}</div>
                        </div>
                        <div class="card-footer">
                            <h2>{{ $barcode->point }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>

@stop