<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriVault - Home</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
</head>
<body>
    <nav>
        <div class="nav-left">
            <h1>AgriVault</h1>
        </div>
        <div class="nav-right">
            <button id="profile">Profile</button>
            <button id="sleep">Sleep</button>
            <button id="logout">Logout</button>
        </div>
    </nav>
    
    <section class="search-section">
        <h2>Find Agricultural Storage Facilities</h2>
        <div>
            <mapbox-search-box
                access-token="pk.eyJ1IjoiY2xhcmlzc2FrIiwiYSI6ImNseHU3ejFnMzFvMjkyanF5dXh0ZnhkYjgifQ.j38d2NQuMTkl7CRSqkJm5A"
                proximity="0,0"
            >
            </mapbox-search-box>
        </div>
        <div id="results"></div>
        <div id="map" style="height: 400px;"></div>
    </section>
    
    <section class="scroll-section">
        <h2>Featured Locations</h2>
        <div class="scroll-container" id="scroll-container">
            <!-- JavaScript will populate this -->
        </div>
    </section>
    
    <footer>
        <p>Contact Us: info@agrivault.com | +123-456-7890</p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
<script>
    const script = document.getElementById('search-js');
    // wait for the Mapbox Search JS script to load before using it
    script.onload = function () {
        // select the MapboxSearchBox instance
        const searchBox = document.querySelector('mapbox-search-box')

        // set the options property
        searchBox.options = {
            language: 'es',
            country: 'MX'
        }

        // add an event listener to handle the `retrieve` event
        searchBox.addEventListener('retrieve', (e) => {
            const feature = e.detail;
            console.log(feature) // geojson object representing the selected item
        });
    }
</script>
</html>
