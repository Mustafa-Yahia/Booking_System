@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Your Payment History</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($cartItems->isEmpty())
    <p class="text-muted">You have not made any payment yet.</p>    @else
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Descrubtion</th>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Payment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($cartItems as $index => $item)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->booking->property->title }}</td> 

        <td>{{ $item->amount }}$</td>
        <td>{{ ucfirst($item->payment_method) }}</td>
        <td>
            @if($item->status == 'completed')
                <span class="badge badge-success">Paid</span>
            @elseif($item->status == 'pending')
                <span class="badge badge-warning">Pending</span>
            @else
                <span class="badge badge-danger">Payment failed</span>
            @endif
        </td>
        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
        <td>
            <form action="{{ route('payment.remove', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment?')">Delete</button>
            </form>
        </td>
    </tr>
@endforeach

            </tbody>
        </table>

        <div class="alert alert-info mt-3">
            <strong>Total Payments:</strong> {{ $totalPrice }}$        </div>
    @endif
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .table {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        width: 100%;
    }

    .table th, .table td {
        text-align: center;
        padding: 15px;
    }

    .table thead {
        background-color: #007bff;
        color: #fff;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    button {
        border: none;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border-radius: 4px;
    }

    button:hover {
        opacity: 0.8;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .alert {
        font-size: 16px;
        margin-top: 20px;
        padding: 15px;
        border-radius: 5px;
    }

    .alert-info {
        background-color: #d1ecf1;
        border-color: #bee5eb;
        color: #0c5460;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .badge {
        font-size: 14px;
        padding: 6px 12px;
        border-radius: 15px;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .alert-info strong {
        font-size: 18px;
        font-weight: bold;
    }

    .container {
        margin-top: 30px;
        margin-bottom: 30px;
    }

    h2 {
        text-align: center;
        color: #343a40;
        font-size: 28px;
        margin-bottom: 30px;
    }

    .table tbody tr:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }
</style>
@endsection
