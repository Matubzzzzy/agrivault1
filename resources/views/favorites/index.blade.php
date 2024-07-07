<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Favorites - AgriVault</title>
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
        <h2>Your Favorites</h2>
        <hr>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @foreach($favorites as $favorite)
            <div class="favorite d-flex justify-content-between align-items-center">
                <div>
                    <h3>{{ $favorite->facility->name }}</h3>
                    <p>{{ $favorite->facility->location }}</p>
                    <p>{{ $favorite->facility->description }}</p>
                    <p>County: {{ $favorite->facility->county }}</p>
                    <p>Slots Available: {{ $favorite->facility->slots_available }}</p>
                    <p>Contact: {{ $favorite->facility->contacts }}</p>
                </div>
                <div>
                <form action="{{ route('favorites.remove', ['facility' => $favorite->facility_id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Remove from Favorites</button>
                </form>
                    <br>
                    <!-- Button to leave review -->
                    <button class="btn btn-green" data-toggle="modal" data-target="#reviewModal{{ $favorite->id }}">
                        Leave a Review
                    </button>
                </div>
            </div>
            <hr>

            <!-- Review Modal -->
            <div class="modal fade" id="reviewModal{{ $favorite->id }}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel{{ $favorite->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-green text-white">
                            <h5 class="modal-title" id="reviewModalLabel{{ $favorite->id }}">Submit Review</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('favorites.review.submit') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="facility_id" value="{{ $favorite->facility->id }}">
                                <div class="form-group">
                                    <label for="rating{{ $favorite->id }}">Rating</label>
                                    <select name="rating" id="rating{{ $favorite->id }}" class="form-control" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="review{{ $favorite->id }}">Review</label>
                                    <textarea name="review" id="review{{ $favorite->id }}" class="form-control" rows="3" required></textarea>
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
        @endforeach

        @if ($favorites->isEmpty())
            <p>No favorites added yet.</p>
        @endif
    </div>

    <!-- Footer -->
    <footer class="footer bg-green text-white text-center mt-4">
        <span>Contact Us: agrivault@example.com | +254123456789</span>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to set modal values dynamically
        $('#reviewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var facilityId = button.data('facility-id');
            var modal = $(this);
            modal.find('.modal-body #facility_id').val(facilityId);
        });
    </script>
</body>
</html>
