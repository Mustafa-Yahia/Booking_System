@extends('layouts.lessor')

@section('title', 'Add new Property')

@section('content')
    <div class="container py-5 mt-4" style="margin-left: 250px;">
        <h2 class="text-center mb-5 fw-bold">🏠 Add New Property</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <div class="card shadow-sm border-0 rounded-lg p-4">
            <form action="{{ route('lessor.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Property Type</label>
                    <select name="type" class="form-select" required>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                        <option value="Villa">Villa</option>
                        <option value="studio">Studio</option>
                        <option value="other">Other</option>

                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter property title" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Describe your property" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="City, Neighborhood" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Price Per Day ($)</label>
                    <input type="number" name="price_per_day" class="form-control" placeholder="100" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Guests Limit</label>
                    <input type="number" name="guest_limit" class="form-control" min="1" placeholder="1" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Property Images</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/jpeg,image/png,image/jpg,image/gif">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5">💾 Save Property</button>
                    <a href="{{ route('lessor.properties.index') }}" class="btn btn-secondary px-5">❌ Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <img src="{{ asset('storage/images/index/cabin.jpg') }}" alt="" class="w-50 h-50 position-absolute top-50 end-0" style="z-index: -1; ">

