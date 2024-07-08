<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriVault - Home</title>
    <link rel="stylesheet" href="{{ asset('/user_homepage_styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav>
        <div class="nav-left">
            <h1>AgriVault</h1>
        </div>
        <div class="nav-right">
            <a href="{{ route('profile.edit') }}" class="nav-button">Profile</a>
            <a href="{{ route('favorites') }}" class="nav-button">Favorites</a>
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
            <label for="county">Select County:</label>
            <select id="county" onchange="filterFacilities(this.value)">
                <option value="">All Counties</option>
                @php
                    $counties = [];
                    foreach ($facilities as $facility) {
                        if (!in_array($facility->county, $counties)) {
                            $counties[] = $facility->county;
                            echo '<option value="' . $facility->county . '">' . $facility->county . '</option>';
                        }
                    }
                @endphp
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
                            <form action="{{ route('favorites.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="facility_id" value="{{ $facility->id }}">
                                <button type="submit" class="btn btn-primary">{{ __('Add to Favorites') }}</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#reviewModal{{ $facility->id }}">{{ __('Reviews') }}</button>
                            </form>
                            
                        </div>
                    </div>

                    <!-- Reviews Modal -->
                    <div class="modal fade" id="reviewModal{{ $facility->id }}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel{{ $facility->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-green text-white">
                                    <h5 class="modal-title" id="reviewModalLabel{{ $facility->id }}">Reviews for {{ $facility->name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach($facility->reviews as $review)
                                        <div>
                                            <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
                                            <p><strong>Review:</strong> {{ $review->review_text }}</p>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            @endif
        </div>
    </section>

    <script>
        // Function to filter facilities based on location
        function filterFacilities(county) {
            const facilities = document.querySelectorAll('.facility');
            facilities.forEach((facility) => {
                const facilityCounty = facility.getAttribute('data-county');
                if (county === '' || facilityCounty === county) {
                    facility.style.display = 'block';
                } else {
                    facility.style.display = 'none';
                }
            });
        }

        // Event listener for Add to Favorites button
        document.querySelectorAll('.add-to-favorites').forEach(button => {
            button.addEventListener('click', function() {
                const facilityId = this.getAttribute('data-facility-id');
                addToFavorites(facilityId);
            });
        });

        function addToFavorites(facilityId) {
            fetch('/favorites/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ facility_id: facilityId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Facility added to favorites!');
                } else {
                    alert('Failed to add facility to favorites.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>

    <footer>
        <p>Contact Us: info@agrivault.com | +123-456-7890</p>
    </footer>

    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.reviewModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var facilityId = button.data('facility-id');
                var modal = $(this);
                modal.find('.modal-body #facility_id').val(facilityId);
            });
        });
    </script>
</body>
</html>
