@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">User List</h1>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Points</th>
                <th>Last Scanned At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->role_name }}</td>
                <td>{{ $user->point }}</td>
                <td>{{ $user->last_scanned_at }}</td>
                <td>{{ $user->status ? $user->status->status_name : 'No Status' }}</td>
                <td class="text-center">
                        {{-- banned --}}
                        <a href="{{ route('user.banned', $user->id) }}" class="btn btn-danger">Ban</a>
                        {{-- edit --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
