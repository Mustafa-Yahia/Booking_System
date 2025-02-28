@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Statistics</h1>

    <div class="row">
{{-- ---------------------------------------------------------------------------------------------------------------------------------- --}}
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Properties</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $propertiesCount }}</h5>
                </div>
            </div>
        </div>
{{-- ---------------------------------------------------------------------------------------------------------------------------------- --}}

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $usersCount }}</h5>
                </div>
            </div>
        </div>
{{-- ---------------------------------------------------------------------------------------------------------------------------------- --}}

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Bookings</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $bookingsCount }}</h5>
                </div>
            </div>
        </div>
{{-- ---------------------------------------------------------------------------------------------------------------------------------- --}}

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Revenue</div>
                <div class="card-body">
                    <h5 class="card-title">${{ number_format($totalRevenue, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
