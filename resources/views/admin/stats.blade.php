@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center fw-bold">📊 Dashboard Statistics</h1>

    <div class="row g-4">
        {{-- Total Properties --}}
        <div class="col-md-3">
            <div style="height: 160px " class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="fas fa-building fa-lg"></i> Total Properties
                </div>
                <div style="display: flex; justify-content: center; align-items: center;" class="card-body">
                    <h1  class="fw-bold text-primary">{{ $propertiesCount }}</h1>
                    {{-- <div class="progress">
                        <div class="progress-bar bg-primary" style="width: {{ ($propertiesCount / 100) * 100 }}%">
                            {{ $propertiesCount }}%
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- Total Users --}}
        <div class="col-md-3">
            <div style="height: 160px" class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-success text-white fw-bold">
                    <i class="fas fa-users fa-lg"></i> Total Users
                </div>
                <div style="display: flex; justify-content: center; align-items: center;" class="card-body">
                    <h1 class="fw-bold text-success">{{ $usersCount }}</h1>
                    {{-- <div class="progress">
                        <div class="progress-bar bg-success" style="width: {{ ($usersCount / 1000) * 100 }}%">
                            {{ $usersCount }}%
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- Total Bookings --}}
        <div class="col-md-3">
            <div style="height: 160px"class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-warning text-dark fw-bold">
                    <i class="fas fa-calendar-check fa-lg"></i> Total Bookings
                </div>
                <div class="card-body">
                    <h2 class="fw-bold text-warning">{{ $bookingsCount }}</h2>
                    <div class="progress">
                        <div class="progress-bar bg-warning" style="width: {{ ($bookingsCount / 500) * 100 }}%">
                            {{ $bookingsCount }}
                        </div>
                    </div>
                    <span>The target is 500/year</span>

                </div>
            </div>
        </div>

        {{-- Total Revenue --}}
        <div class="col-md-3">
            <div style="height: 160px" class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-danger text-white fw-bold">
                    <i class="fas fa-dollar-sign fa-lg"></i> Total Revenue
                </div>
                <div class="card-body">
                    <h2 class="fw-bold text-danger">${{ number_format($totalRevenue, 2) }}</h2>
                    <div class="progress">
                        <div class="progress-bar bg-danger" style="width: {{ ($totalRevenue / 100000) * 100 }}%">
                            ${{ number_format($totalRevenue, 2) }}
                        </div>
                    </div>
                    <span>The target is 100000/year</span>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div style="height: 160px" class="card shadow-sm border-0 rounded-lg text-center">
                <div class="card-header bg-danger text-white fw-bold">
                    <i class="fas fa-dollar-sign fa-lg"></i> Profit
                </div>
                <div class="card-body">
                    <h2 class="fw-bold text-danger">${{ number_format($totalRevenue * 0.05, 2) }}</h2>
                    <div>
                        <span>5% of each booking</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="row mt-5">
        <div style="height: 160px" class="col-md-12">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-dark text-white fw-bold">
                    📈 Booking & Revenue Trends
                </div>
                <div class="card-body">
                    <canvas id="statsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Include Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('statsChart').getContext('2d');

    var statsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Bookings',
                data: [
                    @foreach ($bookingsData as $booking)
                        {{ $booking }},
                    @endforeach
                ],
                borderColor: '#f1c40f',
                fill: false
            }, {
                label: 'Revenue ($)',
                data: [
                    @foreach ($revenueData as $revenue)
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
