@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-8">
        <div class="card shadow-lg rounded text-center">
            <div class="card-header bg-primary text-white py-3">
                <h3 class="mb-0">
                    <i class="fas fa-shopping-cart"></i> Checkout
                </h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Property</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Days</th>
                                <th>Price/Day</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalAmount = 0; @endphp
                            @foreach($bookings as $index => $booking)
                                @php
                                    $startDate = \Carbon\Carbon::parse($booking->start_date); 
                                    $endDate = \Carbon\Carbon::parse($booking->end_date);
                                    
                                    $daysCount = $startDate->diffInDays($endDate) + 1; 
                                    $totalPrice = $daysCount * $booking->property->price_per_day;
                                    $totalAmount += $totalPrice;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $booking->user_id }}</td>  
                                    <td class="text-capitalize">{{ $booking->property->title }}</td>
                                    <td>{{ $startDate->format('Y-m-d') }}</td>
                                    <td>{{ $endDate->format('Y-m-d') }}</td>
                                    <td>{{ $daysCount }}</td>
                                    <td>${{ number_format($booking->property->price_per_day, 2) }}</td>
                                    <td>${{ number_format($totalPrice, 2) }}</td>
                                    <td>
                                        <form action="{{ route('booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="alert alert-info fw-bold" style="margin-bottom: 20px;">
                    <h4>Total Amount: ${{ number_format($totalAmount, 2) }}</h4>
                </div>

                <form action="{{ route('checkout.process') }}" method="POST" class="mt-3">
                    @csrf
                    <a href="{{ route('credit.card') }}" class="btn btn-success m-t-10 w-100 fw-bold">
                        <i class="fas fa-check-circle"></i> Proceed to Payment
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .table {
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        vertical-align: middle;
        padding: 12px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        padding: 12px;
        font-size: 18px;
        transition: all 0.3s ease-in-out;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: scale(1.05);
    }

    select {
        font-size: 16px;
        padding: 10px;
    }

    .alert {
        font-size: 18px;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .delete-btn i {
        margin-right: 5px;
    }

    .delete-btn:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    .delete-btn:focus {
        outline: none;
    }
</style>
@endsection
