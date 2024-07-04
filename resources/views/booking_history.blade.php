<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User History - AgriVault</title>
    <link rel="stylesheet" href="{{ asset('history.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-green">
        <a class="navbar-brand text-white" href="#">AgriVault</a>
        <a href="#" onclick="history.back(); return false;" class="navbar-link">
                <i class="fas fa-arrow-left"></i> Back
            </a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('/') }}">Home</a>
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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($bookings as $booking)
            <div class="booking">
                <h3>{{ $booking->facility->name }}</h3>
                <p>Status: {{ $booking->status }}</p>
                @if ($booking->status == 'closed')
                    <button class="btn btn-green" data-toggle="modal" data-target="#reviewModal" data-booking-id="{{ $booking->id }}">Leave a Review</button>
                @endif
            </div>
        @endforeach

        <!-- Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-green text-white">
                        <h5 class="modal-title" id="reviewModalLabel">Submit Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('user.review.submit') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="booking_id" id="booking_id" value="">
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <select name="rating" id="rating" class="form-control" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="review">Review</label>
                                <textarea name="review" id="review" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-green">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer bg-green text-white text-center mt-4">
        <span>Contact Us: agrivault@example.com | +254123456789</span>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#reviewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var bookingId = button.data('booking-id');
            var modal = $(this);
            modal.find('.modal-body #booking_id').val(bookingId);
        });
    </script>
</body>
</html>
