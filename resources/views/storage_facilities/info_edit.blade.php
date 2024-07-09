{{-- resources/views/storage_facilities/edit.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Facility</title>
    <link rel="stylesheet" href="{{ asset('admin_styles.css') }}">
</head>
<body>
    <nav>
        <div class="nav-left">
            <h1>AgriVault Admin</h1>
            <a href="{{ url('/dashboard') }}" class="navbar-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="nav-right"></div>
    </nav>

    <section>
        <h2>Edit Facility</h2>
        <form id="add-facility-form" method="POST" action="{{ route('storage-facilities.update', $facility->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" id="name" name="name" placeholder="Facility Name" value="{{ $facility->name }}" required>
            <input type="text" id="location" name="location" placeholder="Facility Address" value="{{ $facility->location }}" required>
            <textarea id="description" name="description" placeholder="Description" required>{{ $facility->description }}</textarea>
            <input type="text" id="contacts" name="contacts" placeholder="Facility Contacts" value="{{ $facility->contacts }}" required>
            <input type="text" id="county" name="county" placeholder="County" value="{{ $facility->county }}" required>
            <input type="number" id="slots_available" name="slots_available" placeholder="Number of Available Slots" value="{{ $facility->slots_available }}" required>
            <input type="number" id="total_slots" name="total_slots" placeholder="Total Slots" value="{{ $facility->total_slots }}" required>
            <input type="number" id="price" name="price" placeholder="Price" value="{{ $facility->price }}" required>
            <input type="file" id="image" name="image">
            @if($facility->image)
                <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}" width="100">
            @endif
            <button type="submit" class="btn btn-primary">Update Facility</button>
        </form>
    </section>

    

    <script src="admin_script.js"></script>
</body>
</html>
