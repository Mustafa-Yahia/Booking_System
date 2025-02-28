@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Property</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('lessor.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $property->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ $property->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $property->location }}" required>
        </div>

        <div class="mb-3">
            <label for="price_per_day" class="form-label">Price Per Day</label>
            <input type="number" name="price_per_day" class="form-control" value="{{ $property->price_per_day }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" class="form-control" value="{{ $property->type }}" required>
        </div>

        <div class="mb-3">
            <label for="images" class="form-label">Add New Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <h4>Existing Images</h4>
        <div class="row">
            @foreach($property->images as $image)
            <div class="col-md-3 text-center mb-3">
                <div class="image-container">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Property Image" style="width:100px; height:100px; object-fit:cover;">
                    <form action="{{ route('lessor.property_images.destroy', ['property' => $property->id, 'image' => $image->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                    </form>

                </div>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-4">Update Property</button>
    </form>
</div>
@endsection
