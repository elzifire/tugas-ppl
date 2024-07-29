@extends('layouts.app')

@section('content')

    {{-- saya ingin menampilkan data reward dengan component card boostrap 5 lalu didalam card ada table--}}

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>List Reward</h1>
                <a href="{{ route('admin.rewards.create') }}" class="btn btn-primary">Tambah Hadiah</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Point</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rewards as $reward)
                            <tr>
                                <td>{{ $reward->id }}</td>
                                <td>{{ $reward->name }}</td>
                                <td>{{ $reward->point }}</td>
                                <td>{{ $reward->stock }}</td>
                                <td> <img src="{{ $reward->image }}" alt="" style="width: 100px;"> </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.rewards.edit', $reward->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.rewards.destroy', $reward->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="">
                        <tr>
                            <td colspan="5" class="text-center">
                                {{ $rewards->links() }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


@endsection