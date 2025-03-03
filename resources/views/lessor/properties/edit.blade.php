@extends('layouts.lessor')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center fw-bold">✏️ Edit Property</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
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


    <div class="mb-4">
        <a href="{{ route('lessor.properties.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Properties
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body">
            <form action="{{ route('lessor.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $property->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ old('description', $property->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label fw-bold">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $property->location) }}" required>
                </div>

                <div class="mb-3">
                    <label for="price_per_day" class="form-label fw-bold">Price Per Day ($)</label>
                    <input type="number" name="price_per_day" class="form-control" value="{{ old('price_per_day', $property->price_per_day) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Type</label>
                    <select name="type" class="form-select" required>
                        <option value="apartment" {{ old('type', $property->type) == 'apartment' ? 'selected' : '' }}>Apartment</option>
                        <option value="house" {{ old('type', $property->type) == 'house' ? 'selected' : '' }}>House</option>
                        <option value="villa" {{ old('type', $property->type) == 'villa' ? 'selected' : '' }}>Villa</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="guest_limit" class="form-label fw-bold">Guests Limit</label>
                    <input type="number" name="guest_limit" class="form-control" value="{{ old('guest_limit', $property->guest_limit) }}" required>
                </div>

                <div class="mb-3">
                    <label for="images" class="form-label fw-bold">Add New Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>

                <button type="submit" class="btn btn-primary w-100">💾 Update Property</button>
            </form>
        </div>
    </div>

    <h4 class="mt-5 fw-bold text-center">🖼️ Existing Images</h4>
    <div class="row g-4">
        @foreach($property->images as $image)
        <div class="col-md-3 text-center">
            <div class="card shadow-sm border-0 rounded-lg">
                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Property Image" class="card-img-top" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <form action="{{ route('lessor.property_images.destroy', ['property' => $property->id, 'image' => $image->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Are you sure you want to delete this image?')">🗑️ Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
