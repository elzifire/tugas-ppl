@extends('layouts.app')


@section('content')

{{-- menampilkan leaderboard dengan card boostrap 5  --}}
<div class="card">
    <div class="card-header"><h5>Leaderboard</h5></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Skor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->point }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
   

@endsection