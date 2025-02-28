@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Properties List</h1>

    <form method="GET" action="{{ route('admin.properties.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by title or location"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="rented" {{ request('status') == 'rented' ? 'selected' : '' }}>Rented</option>
                </select>
            </div>

            <div class="col-md-2">
                <select name="sort" class="form-control">
                    <option value="">Sort By</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Price/Day</th>
                <th>Status</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr>
                    <td>{{ $property->title }}</td>
                    <td>{{ $property->location }}</td>
                    <td>${{ number_format($property->price_per_day, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $property->status == 'available' ? 'success' : 'danger' }}">
                            {{ ucfirst($property->status) }}
                        </span>
                    </td>
                    <td>
                        @foreach($property->images as $image)
                            <img src="{{ asset('storage/'.$image->image_path) }}" class="img-thumbnail"
                                 style="width: 100px; height: auto;" alt="Property Image">
                        @endforeach
                    </td>
                    <td>
                        <form action="{{ route('admin.properties.delete', $property->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
