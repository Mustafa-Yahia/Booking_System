@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4 rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone</label>
                            <input type="num" class="form-control" name="phone" id="phone" value="{{ $user->phone }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Leave blank to keep current password">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="lessor" {{ $user->role == 'lessor' ? 'selected' : '' }}>Lessor</option>
                                <option value="renter" {{ $user->role == 'renter' ? 'selected' : '' }}>Renter</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Update User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
