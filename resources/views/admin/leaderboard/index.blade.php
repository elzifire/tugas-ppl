@extends('layouts.app')


@section('content')

{{-- menampilkan leaderboard dengan card boostrap 5  --}}
<div class="card">
    <div class="card-header">
        <h3>Leaderboard</h3>
           {{-- fitur search dengan name=q --}}
        <form action="{{ route('admin.leaderboard') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="q">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
    </div>
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
            <tfoot>
                <tr>
                    <td colspan="3">
                        {{ $users->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
   

@endsection