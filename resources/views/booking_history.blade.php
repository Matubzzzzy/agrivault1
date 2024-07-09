<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History - AgriVault</title>
    <link rel="stylesheet" href="{{ asset('history.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-green">
        <a class="navbar-brand text-white" href="#">AgriVault</a>
        <a href="{{ url('/home') }}" class="navbar-link">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/sleep') }}">Sleep</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Your Booking History</h2>
        <hr>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($bookings as $booking)
            <div class="booking d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $booking->facility->name }}</h3>
                    <p>Total Price: Ksh.{{ $booking->total_price }}</p>
                </div>
                <div>
                    <!-- Button to view booking info -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#bookingInfoModal{{ $booking->id }}">
                        Booking Info
                    </button>
                    <!-- Button to leave review -->
                    
                </div>
            </div>
            <hr>

            <!-- Booking Info Modal -->
            <div class="modal fade" id="bookingInfoModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingInfoModalLabel{{ $booking->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="bookingInfoModalLabel{{ $booking->id }}">Booking Information</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Facility Name: {{ $booking->facility->name }}</p>
                            <p>Location: {{ $booking->facility->location }}</p>
                            <p>Total Price: Ksh.{{ $booking->total_price }}</p>
                            <p>Start Date: {{ $booking->start_date }}</p>
                            <p>End Date: {{ $booking->end_date }}</p>
                            <p>Information: {{ $booking->info }}</p>
                            <!-- Add more fields as needed -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Modal -->
            
        @endforeach

        @if ($bookings->isEmpty())
            <p>No bookings made yet.</p>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer bg-green text-white text-center mt-4">
        <span>Contact Us: agrivault@example.com | +254123456789</span>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
