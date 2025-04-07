@extends('layouts.userProfile')

@section('main')
<div class="container">
    <div class="profile-header mt-n5 mb-4">
        <h1>{{ucfirst(Auth::user()->name)}} Profile</h1>
      </div>
    @if($bookings->isEmpty())
    <div class="text-center">

        <h2 >My Bookings</h2>
        <p >You have no bookings at the moment.</p>
    </div>
    @else
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
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


        
    <h2 >My Bookings</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Property</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->property->title }}</td>
                        <td>{{ $booking->start_date}}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td>
                            @if($booking->status == 'confirmed')
                                <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                            @elseif($booking->status == 'cancelled')
                                <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                            @else
                                <span class="badge bg-warning">{{ ucfirst($booking->status) }}</span>
                            @endif
                        </td>
                        <td>${{ number_format($booking->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection


