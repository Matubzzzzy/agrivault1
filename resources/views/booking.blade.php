<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Request Page</title>
    <link rel="stylesheet" href="{{ asset('booking_styles.css') }}">
</head>
<body>
    <nav>
        <div class="nav-left">
            <h1>AgriVault</h1>
            <a href="{{ url('/home') }}" class="navbar-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        
    </nav>

    <div class="container">
        <h1 class="main-heading">Make A Booking</h1>

        <div id="facility-info">
            <h2>Facility Information</h2>
            <p>Facility Name: {{ $facility->name }}</p>
            <p>Location: {{ $facility->location }}</p>
            <p>Available Slots: {{ $facility->slots_available }}</p>
        </div>

        @if($facility->slots_available < 1)
            <div id="not-available">
                <h2>Facility Not Available</h2>
                <p>Sorry, this facility has no available slots.</p>
            </div>
        @else
            <div id="booking-form-section">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div id="alert alert-success">
                        <h2>Thank you for your request!</h2>
                        <p>We will get back to you soon.</p>
                    </div>
                @endif

                @if(session('error'))
                    <div id="error">
                        <h2>Error</h2>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <form id="bookingForm" action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="facility_id" value="{{ $facility->id }}">

                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>

                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>

                    <label for="slots">Number of Slots:</label>
                    <input type="number" id="slots" name="slots" min="1" max="{{ $facility->slots_available }}" required>

                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" required>

                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" name="end_date" required>

                    <label for="info">Information About Your Request:</label>
                    <textarea id="info" name="info" required></textarea>

                    <button type="submit">Submit Request</button>
                </form>
            </div>
        @endif

        
    </div>

    

    <script src="{{ asset('script.js') }}"></script>
</body>
</html>