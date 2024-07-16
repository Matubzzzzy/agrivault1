
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Request Page</title>
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
            <p>Available Slots: {{ $facility->slots_available }} / {{ $facility->total_slots }}</p>
            <p>Price: Ksh.{{ $facility->price }} per slot</p>
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

                    <!-- Total Price Section -->
                    <div id="total-price-section">
                        <h3>Total Price: <span id="total-price-display">0</span></h3>
                        <p>(This price shall be paid on site.)</p>
                    </div>
                    <input type="hidden" id="total_price" name="total_price" value="0">
                    <br>

                    <button type="submit">Submit Request</button>
                </form>
            </div>
        @endif

        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slotsInput = document.getElementById('slots');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const totalPriceElement = document.getElementById('total-price-display');
            const totalPriceInput = document.createElement('input');
            totalPriceInput.type = 'hidden';
            totalPriceInput.name = 'total_price';
            document.getElementById('bookingForm').appendChild(totalPriceInput);

            const pricePerSlot = {{ $facility->price }};

            function calculateNumberOfDays(startDate, endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const timeDiff = end - start;
                const daysDiff = timeDiff / (1000 * 3600 * 24) + 1; // Include both start and end date
                return daysDiff > 0 ? daysDiff : 0;
            }

            function updateTotalPrice() {
                const numberOfSlots = parseInt(slotsInput.value) || 0;
                const startDate = startDateInput.value;
                const endDate = endDateInput.value;
                const numberOfDays = calculateNumberOfDays(startDate, endDate);
                const totalPrice = numberOfSlots * pricePerSlot * numberOfDays;
                totalPriceElement.textContent = totalPrice.toFixed(2);
                totalPriceInput.value = totalPrice.toFixed(2);
            }

            slotsInput.addEventListener('input', updateTotalPrice);
            startDateInput.addEventListener('change', updateTotalPrice);
            endDateInput.addEventListener('change', updateTotalPrice);

            // Initialize total price on page load
            updateTotalPrice();
        });
    </script>


    
</body>
</html>
