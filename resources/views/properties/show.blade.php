@extends('layouts.app')

@section('title', $property->title)
<link rel="stylesheet" href="{{asset('css/property-detail.css')}}">
<script src="{{asset('js/booking.js')}}" defer></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

@section('content')
@php
    $allowed = true;
@endphp
<p id="property-id" data-id='{{$property->id}}'></p>
<p id="price" data-id='{{$property->price_per_day}}'></p>
<section class="property-detail">
    <div class="container">
        <!-- Property Images  -->
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
                <h1>{{ ucfirst($property->title) }}</h1>
                <p class="location"><i class="fas fa-map-marker-alt"></i> {{ $property->location }}</p>

                <div class="details">
                    <p><strong>Status:</strong> {{ ucfirst($property->status) }}</p>
                    <p><strong>Price per night:</strong> {{ number_format($property->price_per_day, 2) }} JOD</p>
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
                    <h2>{{ number_format($property->price_per_day, 2) }} JOD <span> / night</span></h2>
                    <form action="{{route('payment.index')}}" method="GET" onsubmit="return checkAvailability(event)">
                        @csrf
                        @if(Auth::check())
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id="user_id">
                        @endif
                        <label for="checkin">Check-in</label>
                        <input type="date" id="checkin" name="checkin" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">

                        <label for="checkout">Check-out</label>
                        <input type="date" id="checkout" name="checkout" value="{{ \Carbon\Carbon::now()->addDays(4)->format('Y-m-d') }}">

                        <label for="guests">Guests</label>
                        <select id="guests" name="guests">
                            @for ($i =1 ; $i <= $property->guest_limit ; $i++)
                            <option value="{{$i}}">{{$i}} Guest</option>

                            @endfor
                        </select>
                        <input type="hidden" name="property_id" value="{{$property->id}}">
                        <input type="hidden" name="owner" value="{{$property->owner->id}}">
                        <input type="hidden" name="price" value="{{$property->price_per_day}}">

                        <button type="submit" class="primary-btn">Check availability</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- displays reviews --}}
    <div class="reviews-section">

        @if($reviews->count() > 0)
        <h2 class="text-center">Reviews</h2>
        <div class="reviews">
            @foreach ($reviews as $review)
            <div class="card">
                <div class="user">
                    <img src="{{asset('storage/' . $review->user->image)}}" alt="" class="profile-pic">
                    <span>{{ucfirst($review->user->name)}}</span>
                    <br>
                </div>
                <div >
                    @for ($i = 0; $i < $review->rating; $i++)
                    <span><i class='bx bxs-star bx-review'></i></span>
                    @endfor

                </div>
                    <small>{{$review->created_at->format('Y-m-d')}}</small>
                <div class="review-body">
                    <p>{{$review->comment}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="pagination">
        {{ $reviews->links('pagination::simple-bootstrap-4') }}
    </div>
    @else
        <h2 class="text-center">No reviews yet</h2>
    @endif

    {{-- add a review only for renters --}}
    {{-- @if(Auth::check() && Auth::user()->role == 'renter') --}}
    <form action="{{route('reviews.store')}}" method="POST" class="review-form" onsubmit="return validateForm()">
        @csrf
        <div class="rating">
            <span onclick="rate(1)"><i class='bx bx-star bx-md'></i></span>
            <span onclick="rate(2)"><i class='bx bx-star bx-md'></i></span>
            <span onclick="rate(3)"><i class='bx bx-star bx-md'></i></span>
            <span onclick="rate(4)"><i class='bx bx-star bx-md'></i></span>
            <span onclick="rate(5)"><i class='bx bx-star bx-md'></i></span>
        </div>
        <p class="error" id="rating-err"></p>
        <input type="hidden" name="stars" id="stars" value="0">
        @if(Auth::check())
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" id='user_id_review'>
        @endif
        <input type="hidden" name="property_id" value="{{$property->id}}">
        <textarea name="review" id="review" placeholder="Your review" cols="50" rows="5" class="review-textarea"></textarea>
        <p class="error" id="review-err"></p>
        @if (Auth::check())
        <?php $allowed = Auth::user()->bookings->where('user_id', Auth::user()->id)->where('property_id', $property->id)->count() > 0 ? true : false ?>

        @endif
        <p class="error me-2">{{ $allowed ? "" : "You can't review unless you book this property"}}</p>
        <button type="submit" class="primary-btn" {{$allowed ? '' : 'disabled'}}>Add a Review</button>

    </form>
    {{-- @endif --}}

</section>

@endsection
