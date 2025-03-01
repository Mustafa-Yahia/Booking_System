@extends('layouts.app')

@section('title', $property->title)
<link rel="stylesheet" href="{{asset('css/property-detail.css')}}">
<script src="{{asset('js/booking.js')}}" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('content')

<p id="property-id" data-id='{{$property->id}}'></p>
<section class="property-detail">
    <div class="container">
        <!-- Property Images (Grid Layout) -->
        <div class="property-images">
            @if ($images->count() > 0)
                <div class="image-grid">
                    <div class="main-image">
                        <img src="{{ asset('storage/' . $images[0]->image_path) }}" alt="{{ $property->title }}">
                    </div>
                    <div class="secondary-images">
                        @foreach ($images->skip(1) as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $property->title }}">
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Property Info -->
        <div class="property-content">
            <div class="left-column">
                <h1>{{ $property->title }}</h1>
                <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</p>

                <div class="details">
                    <p><strong>Status:</strong> {{ ucfirst($property->status) }}</p>
                    <p><strong>Price per night:</strong> ${{ number_format($property->price_per_day, 2) }}</p>
                    <br>
                    <h2>About this property</h2>
                    <p class="description">{{ $property->description }}</p>
                </div>

                <div class="owner-details">

                        <div>
                            <p><strong>Keep in touch with {{ $property->owner->name }}</strong></p>

                        </div>
                        <div class="small">
                            <p>{{ $property->owner->email }} | {{ $property->owner->phone }}</p>
                        </div>

                </div>
            </div>

            <!-- Booking Section -->
            <div class="right-column">
                <div class="booking-box">
                    <h2>${{ number_format($property->price_per_day, 2) }} <span> / night</span></h2>
                    <form action="{{route('booking.store')}}" method="POST">
                        @csrf
                        <label for="checkin">Check-in</label>
                        <input type="date" id="checkin" name="checkin" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">

                        <label for="checkout">Check-out</label>
                        <input type="date" id="checkout" name="checkout" value="{{ \Carbon\Carbon::now()->addDays(4)->format('Y-m-d') }}">

                        <label for="guests">Guests</label>
                        <select id="guests" name="guests">
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                        </select>
                        <input type="hidden" name="property_id" id="" value="{{$property->id}}">
                        <input type="hidden" name="owner" id="" value="{{$property->owner->id}}">
                        <input type="hidden" name="price" id="" value="{{$property->price_per_day}}">

                        <button type="submit" class="primary-btn">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



</section>

@endsection
