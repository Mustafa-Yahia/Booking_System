@extends('layouts.admin')

@section('content')
    <h1>Edit Property</h1>
    <form action="{{ route('admin.properties.update', $property->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $property->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" required>{{ $property->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" name="location" id="location" value="{{ $property->location }}" required>
        </div>
        <div class="form-group">
            <label for="price_per_day">Price per day</label>
            <input type="number" class="form-control" name="price_per_day" id="price_per_day" value="{{ $property->price_per_day }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="rented" {{ $property->status == 'rented' ? 'selected' : '' }}>Rented</option>
            </select>
        </div>
        <button type="submit" class="btn btn-warning mt-3">Update Property</button>
    </form>
@endsection
