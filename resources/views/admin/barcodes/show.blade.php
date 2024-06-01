<!-- resources/views/admin/barcodes/show.blade.php -->

@extends('layouts.app')

@section('content')

    {{-- detail barcode --}}
    <div class="container">
        <div class="card">
            <div class="card-title d-print-none">
                <h1 class="text-center">Barcode</h1>
            </div>
            <div class="card-body">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Barcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{!! $qrCode !!}</td>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3">
                          <a href="{{ route('admin.barcodes.index') }}" class="btn btn-primary d-print-none">Kembali</a>
                        </td>
                        <td colspan="2" class="text-end">
                          <button onclick="print()" class="btn btn-danger text-end">Print Pdf</button>
                        </td>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>



@stop
