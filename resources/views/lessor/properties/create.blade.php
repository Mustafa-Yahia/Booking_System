<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Property</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center mb-5 fw-bold">🏠 Add New Property</h2>
        <div class="card shadow-sm border-0 rounded-lg p-4">
            <form action="{{ route('lessor.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Property Type</label>
                    <select name="type" class="form-select" required>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                        <option value="villa">Villa</option>
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
</body>
</html>
