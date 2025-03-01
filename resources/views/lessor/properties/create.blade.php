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
        <h2 class="text-center mb-4">Add New Property</h2>
        <div class="card p-4">
            <form action="{{ route('lessor.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Property Type</label>
                    <select name="type" class="form-control" required>
                        <option value="apartment">Apartment</option>
                        <option value="house">House</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price Per Day ($)</label>
                    <input type="number" name="price_per_day" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Property Images</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/jpeg,image/png,image/jpg,image/gif">
                </div>
                <button type="submit" class="btn btn-success">Save Property</button>
                <a href="{{ route('lessor.properties.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
