@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bank Soal</h5>
                    <p class="card-text"><span>{{ App\Models\Quiz::count() ?? '0' }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">USERS</h5>
                    <p class="card-text"><span>{{ App\Models\User::count() ?? '0' }}</span></p>
                </div>
            </div>
        </div>
    </div>
   
        

@endsection

