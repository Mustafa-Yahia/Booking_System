@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="name">Address</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="lessor" {{ $user->role == 'lessor' ? 'selected' : '' }}>Lessor</option>
                <option value="renter" {{ $user->role == 'renter' ? 'selected' : '' }}>Renter</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Update User</button>
    </form>
@endsection
