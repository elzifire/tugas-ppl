@extends('layouts.app')

@section('content')
<div class="container">
   
    <div class="card">
        <div class="card-body">
            <h4><span>User</span></h4>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Users List
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th>Point</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <img src="{{ $user->image }}" alt="{{ $user->name }}" width="50">
                            </td>
                            <td>{{ $user->point }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                               {{-- delete user --}}
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Tambahkan pesan jika tidak ada pengguna yang ditemukan -->
            @if($users->isEmpty())
                <div class="alert alert-warning mt-3" role="alert">
                    No users found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
