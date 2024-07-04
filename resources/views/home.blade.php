<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriVault - Home</title>
    <link rel="stylesheet" href="{{ asset('/user_homepage_styles.css') }}">
</head>
<body>
    <nav>
        <div class="nav-left">
            <h1>AgriVault</h1>
        </div>
        <div class="nav-right">
            <a href="{{ route('profile.edit') }}" class="nav-button">Profile</a>
            <button id="sleep">Sleep</button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-button">Logout</button>
            </form>
        </div>
    </nav>
    
    <section class="search-section">
    <h2>Find Agricultural Storage Facilities</h2>
    
    <!-- Dropdown menu for locations -->
    <div class="location-dropdown">
        <label for="location">Select Location:</label>
        <select id="location" onchange="filterFacilities(this.value)">
            <option value="">All Locations</option>
            @foreach($locations as $location)
                <option value="{{ $location }}">{{ $location }}</option>
            @endforeach
        </select>
    </div>
    
    <div id="facilities-list">
        @if($facilities->isEmpty())
            <p>{{ __('No facilities available.') }}</p>
        @else
            <div class="container">
            @foreach($facilities as $facility)
                <div class="facility" data-location="{{ $facility->location }}">
                    
                    <div>
                        <h3>{{ $facility->name }}</h3>
                        <p>{{ $facility->location }}</p>
                        <p>{{ $facility->description }}</p>
                        <p>County: {{ $facility->county }}</p> <!-- Display county -->
                        <p>Slots Available: {{ $facility->slots_available }}</p> <!-- Display slots available -->
                        <p>Contact: {{ $facility->contacts }}</p>
                        <a href="{{ url('/booking', ['id' => $facility->id]) }}" class="btn Make-booking">{{ __('Make Booking') }}</a>
                        <hr>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    </div>
</section>

<script>
    // Function to filter facilities based on location
    function filterFacilities(location) {
        const facilities = document.querySelectorAll('.facility');
        
        facilities.forEach((facility) => {
            const facilityLocation = facility.getAttribute('data-location');
            
            if (location === '' || facilityLocation === location) {
                facility.style.display = 'block';
            } else {
                facility.style.display = 'none';
            }
        });
    }
</script>

    
    <footer>
        <p>Contact Us: info@agrivault.com | +123-456-7890</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>

