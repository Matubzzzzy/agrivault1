<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriVault Admin - Dashboard</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <nav>
        <div class="nav-left">
            <h1>AgriVault Admin</h1>
        </div>
        <div class="nav-right">
            <button id="dashboard">Dashboard</button>
            <button id="manage-facilities">Manage Facilities</button>
            <button id="user-requests">User Requests</button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <button href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">Logout</button>
        </div>
    </nav>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section id="dashboard-section">
        <h2>Dashboard Overview</h2>
        <div class="stats">
            <div class="stat">
                <h3>Number of Facilities</h3>
                <p id="facility-count">{{ $facilities->count() }}</p>
            </div>
            <div class="stat">
                <h3>Recent Requests</h3>
                <p id="request-count">0</p>
            </div>
        </div>
    </section>
    
    <section id="manage-facilities-section" class="hidden">
    <h2>Manage Facilities</h2>
    <form id="add-facility-form" method="POST" action="{{ route('storage-facilities.store') }}">
        @csrf
        <input type="text" class="form-control" id="name" name="name" placeholder="Facility Name" required>
        <input type="text" class="form-control" id="location" name="location" placeholder="Facility Address" required>
        <textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
        <input type="text" class="form-control" id="contacts" name="contacts" placeholder="Facility Contact" required>
        <input type="text" class="form-control" id="county" name="county" placeholder="County" required>
        <input type="number" class="form-control" id="slots_available" name="slots_available" placeholder="Slots Available" required>
        <input type="file" class="form-control" id="image" name="image">
        
        <button type="submit" class="btn btn-primary">{{ __('Add Facility') }}</button>
    </form>

    <hr>

    <h3>{{ __('Existing Facilities') }}</h3>
    <div id="facilities-list">
    @if($facilities->isEmpty())
        <p>{{ __('No facilities available.') }}</p>
    @else
        <div class="facilities-container">
            @foreach($facilities as $facility)
                <div class="facility">
                    <img src="{{ $facility->image ? asset('storage/' . $facility->image) : asset('images/facility_placeholder.png') }}" alt="{{ $facility->name }}">
                    <div>
                        <h3>{{ $facility->name }}</h3>
                        <p>{{ $facility->location }}</p>
                        <p>County: {{ $facility->county }}</p>
                        <p>Slots Available: {{ $facility->slots_available }}</p>
                        <p>{{ $facility->description }}</p>
                        <p>Contact: {{ $facility->contacts }}</p>
                        <button onclick="window.location.href='{{ route('storage-facilities.edit', $facility->id) }}'" class="btn btn-sm btn-warning">{{ __('Edit') }}</button>
                        <form action="{{ route('storage-facilities.destroy', $facility->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                        </form>
                        <hr>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</section>

    
    <section id="user-requests-section" class="hidden">
        <h2>User Requests</h2>
        <div id="requests-list">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @foreach($bookings as $booking)
            <div class="booking">
                <h3>{{ $booking->facility->name }}</h3>
                <p>Username: {{ $booking->user->name }}</p>
                <p>Email: {{ $booking->email }}</p>
                <p>Phone: {{ $booking->phone }}</p>
                <p>Info: {{ $booking->info }}</p>
                <button class="btn btn-green" data-toggle="modal" data-target="#invoiceModal" data-booking-id="{{ $booking->id }}">Generate Invoice</button>
            </div>
        @endforeach

        <!-- Invoice Modal -->
        <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-green text-white">
                        <h5 class="modal-title" id="invoiceModalLabel">Generate Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.generateInvoice') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="booking_id" id="booking_id" value="">
                            <p>Generate an invoice for this booking.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-green">Generate Invoice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    
    <!-- <footer>
        <p>Contact Support: admin@agrivault.com | +123-456-7890</p>
    </footer> -->

    <script src="admin_script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#invoiceModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var bookingId = button.data('booking-id');
            var modal = $(this);
            modal.find('.modal-body #booking_id').val(bookingId);
        });
    </script>
</body>
</html>
