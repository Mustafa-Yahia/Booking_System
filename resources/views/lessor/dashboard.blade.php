@extends('layouts.lessor')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center fw-bold">📊 Lessor Dashboard</h1>

    <div class="row g-4">
        {{-- My Properties --}}
        <div class="col-md-4">
            <div style="height: 160px" class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-building fa-lg"></i> My Properties
                </div>
                <div style="display: flex; justify-content: center; align-items: center;" class="card-body">
                    <h1 class="fw-bold text-primary">{{ $myPropertiesCount }}</h1>
                </div>
            </div>
        </div>

        {{-- Bookings on My Properties --}}
        <div class="col-md-4">
            <div style="height: 160px" class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="fas fa-calendar-check fa-lg"></i> My Bookings
                </div>
                <div style="display: flex; justify-content: center; align-items: center;" class="card-body">
                    <h1 class="fw-bold text-success">{{ $myBookingsCount }}</h1>
                </div>
            </div>
        </div>

        {{-- Revenue from My Properties --}}
        <div class="col-md-4">
            <div style="height: 160px" class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-danger text-white fw-bold">
                    <i class="fas fa-dollar-sign fa-lg"></i> My Revenue
                </div>
                <div class="card-body">
                    <h2 class="fw-bold text-danger">{{ number_format($myTotalRevenue  - ($myTotalRevenue * 0.05 ), 2) }} JOD</h2>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ ($myTotalRevenue / 100000) * 100 }}%">
                            {{ number_format($myTotalRevenue , 2) }}JOD
                        </div>
                    </div>
                    <span>Target is 100,000 JOD/year</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-dark text-white fw-bold">
                    📈 Booking & Revenue Trends
                </div>
                <div class="card-body">
                    <canvas id="myStatsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('myStatsChart').getContext('2d');

    var myStatsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'My Bookings',
                data: [
                    @foreach ($myBookingsData as $booking)
                        {{ $booking }},
                    @endforeach
                ],
                borderColor: '#f1c40f',
                fill: false
            }, {
                label: 'My Revenue ($)',
                data: [
                    @foreach ($myRevenueData as $revenue)
                        {{ $revenue }},
                    @endforeach
                ],
                borderColor: '#e74c3c',
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

@endsection
