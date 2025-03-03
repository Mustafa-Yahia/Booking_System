@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg p-4 rounded">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Add New User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone</label>
                            <input type="num" class="form-control" name="phone" id="phone" placeholder="Enter phone number" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter address" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Re-enter password" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label fw-bold">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option value="admin">Admin</option>
                                <option value="lessor">Lessor</option>
                                <option value="renter">Renter</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
