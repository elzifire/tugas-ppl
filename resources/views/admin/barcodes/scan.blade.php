<!-- resources/views/admin/barcodes/scan.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Scan Barcode</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div id="interactive" class="viewport"></div>
    <div id="result" class="alert alert-info" style="display: none;"></div>

    <form id="barcodeForm" action="{{ route('barcodes.processScan') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="barcode" id="barcodeInput">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.min.js"></script>
<script>
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#interactive'),
            constraints: {
                facingMode: "environment" // atau "user" untuk menggunakan kamera depan
            },
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader", "upc_reader"] // Sesuaikan jenis barcode reader
        }
    }, function(err) {
        if (err) {
            console.error(err);
            return;
        }
        console.log("QuaggaJS berhasil diinisialisasi.");
        Quagga.start();
    });

    Quagga.onDetected(function(result) {
        var code = result.codeResult.code;
        document.getElementById("result").innerText = "Detected code: " + code;
        document.getElementById("result").style.display = "block";

        // Kirim barcode ke server untuk diproses
        document.getElementById("barcodeInput").value = code;
        document.getElementById("barcodeForm").submit();
    });
</script>
@endsection
