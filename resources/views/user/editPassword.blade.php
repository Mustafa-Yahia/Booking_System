@extends('layouts.userProfile')

@section('main')
<div class="flex-col">


    <!-- Change Password Section -->
    <div class="info-container mt-4">
        <h4><i class="fas fa-lock"></i> Change Password</h4>
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Current Password</label>
                <input type="password" class="form-control" placeholder="Enter current password" name="current_password">
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" placeholder="Enter new password" name="password">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" placeholder="Confirm new password" name="password_confirmation">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="btn btn-primary w-100">Update Password</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
