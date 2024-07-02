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
            <a href="#" onclick="history.back(); return false;" class="navbar-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div class="nav-right">
            
            
        </div>
    </nav>

    <section>
        <h2>Edit Facility</h2>
        <form id="add-facility-form" method="POST" action="{{ route('storage-facilities.update', $facility->id) }}">
            @csrf
            @method('PUT')
            
                
                <input type="text" id="name" name="name" value="{{ $facility->name }}" required>
            
                <input type="text" id="location" name="location" value="{{ $facility->location }}" required>
            
                <textarea id="description" name="description" required>{{ $facility->description }}</textarea>
            
                <input type="text" id="contacts" name="contacts" value="{{ $facility->contacts }}" required>
            
            <button type="submit" class="btn btn-primary">Update Facility</button>
        </form>
    </section>

    <footer>
        <p>Contact Support: admin@agrivault.com | +123-456-7890</p>
    </footer>

    <script src="admin_script.js"></script>
</body>
</html>
