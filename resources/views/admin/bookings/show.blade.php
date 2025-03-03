@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0 rounded">
            <div class="card-header bg-dark text-white text-center">
                <h2>Booking Details</h2>
            </div>
            <div class="card-body p-4">
                {{-- <h5 class="card-title text-center mb-4">Booking #{{ $booking->id }}</h5> --}}

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Property:</strong> {{ $booking->property->title ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>User:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Price:</strong> <span class="badge bg-success">${{ number_format($booking->total, 2) }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> <span class="badge bg-warning text-dark">{{ ucfirst($booking->status) }}</span></p>
                    </div>
                </div>

                <div class="te'adxt-center mt-4">
                    <a href="@php echo route('admin.bookings.index'); @endphp" class="btn btn-secondary">Back to Bookings</a>
                </div>
            </div>
        </div>
    </div>
@endsection
