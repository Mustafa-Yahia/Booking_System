@extends('layouts.admin')

@section('content')
<script src="{{asset('js/admin/manageForms.js')}}" defer></script>
<div class="container mt-4">
    <h1>Users List</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or email"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <select name="role" class="form-control">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="lessor" {{ request('role') == 'lessor' ? 'selected' : '' }}>Lessor</option>
                    <option value="renter" {{ request('role') == 'renter' ? 'selected' : '' }}>Renter</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>

                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return validateDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
