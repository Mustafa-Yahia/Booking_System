@extends('layouts.admin')

@section('content')
    <h1>Booking Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Booking #{{ $booking->id }}</h5>
            <p><strong>Property:</strong> {{ $booking->property->title ?? 'N/A' }}</p>
            <p><strong>User:</strong> {{ $booking->user->name ?? 'N/A' }}</p>
            <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
            <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
            <p><strong>Price:</strong> ${{ $booking->total }}</p>
            <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>

            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to Bookings</a>
        </div>
    </div>
@endsection
