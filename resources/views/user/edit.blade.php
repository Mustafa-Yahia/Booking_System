@extends('layouts.userProfile')

@section('main')
<div class="flex-col">

    <div class="info-container mt-4">
        <h4><i class="fas fa-user-edit"></i> Update Personal Information</h4>
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" placeholder="Enter full name" name="name" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="number" class="form-control" placeholder="phone number" name="phone" value="{{$user->phone}}">
            </div>
            <div class="mb-3">
                <label class="form-label">address</label>
                <input type="text" class="form-control" placeholder="address" name="address" value="{{$user->address}}">
            </div>
            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
