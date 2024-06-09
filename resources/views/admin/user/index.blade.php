@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">User List</h1>
        {{-- implementasikan fitur search  --}}
        <form action="{{ route('user.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="q">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
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

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="">
                <tr>
                    <td colspan="8" class="text-center">
                        {{ $users->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>


    </div>
@endsection
