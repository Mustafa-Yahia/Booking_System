@extends('layouts.lessor')

@section('title', 'Manage Bookings')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center fw-bold">📖 Bookings for {{ $property->title }}</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Back to Properties Button --}}
    <div class="mb-4 text-center">
        <a href="{{ route('lessor.properties.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Properties
        </a>
    </div>

    {{-- Bookings Table --}}
    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark text-center">
                    <tr>
                        <th>User</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Price ($)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>${{ number_format($booking->total, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>confirmed</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                                        </select>
                                    </form>
                                    <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">🗑️ Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
