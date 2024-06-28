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
    
    <section id="dashboard-section">
        <h2>Dashboard Overview</h2>
        <div class="stats">
            <div class="stat">
                <h3>Number of Facilities</h3>
                <p id="facility-count">0</p>
            </div>
            <div class="stat">
                <h3>Recent Requests</h3>
                <p id="request-count">0</p>
            </div>
        </div>
    </section>
    
    <section id="manage-facilities-section" class="hidden">
        <h2>Manage Facilities</h2>
        <form id="add-facility-form">
            <input type="text" id="facility-name" placeholder="Facility Name" required>
            <input type="text" id="facility-address" placeholder="Facility Address" required>
            <input type="email" id="facility-contact" placeholder="Facility Contact" required>
            <input type="file" id="facility-image" accept="image/*" required>
            <button type="submit">Add Facility</button>
        </form>
        <div id="facilities-list"></div>
    </section>
    
    <section id="user-requests-section" class="hidden">
        <h2>User Requests</h2>
        <div id="requests-list"></div>
    </section>
    
    <footer>
        <p>Contact Support: admin@agrivault.com | +123-456-7890</p>
    </footer>

    <script src="admin_script.js"></script>
</body>
</html>
