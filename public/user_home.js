// Initialize Mapbox
mapboxgl.accessToken = 'pk.eyJ1IjoiY2xhcmlzc2FrIiwiYSI6ImNseHU3ejFnMzFvMjkyanF5dXh0ZnhkYjgifQ.j38d2NQuMTkl7CRSqkJm5A';
const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [0, 0],
    zoom: 2
});

document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const location = document.getElementById('location').value;
    const resultsDiv = document.getElementById('results');
    
    fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(location)}.json?access_token=${mapboxgl.accessToken}`)
        .then(response => response.json())
        .then(data => {
            const features = data.features;
            if (features.length > 0) {
                const firstFeature = features[0];
                const coords = firstFeature.geometry.coordinates;

                // Center map on the searched location
                map.flyTo({
                    center: coords,
                    essential: true,
                    zoom: 12
                });

                // Add a marker for the location
                new mapboxgl.Marker()
                    .setLngLat(coords)
                    .addTo(map);

                // Clear previous results
                resultsDiv.innerHTML = '';

                // Simulate an API call to search for storage facilities
                setTimeout(() => {
                    const facilities = [
                        { name: 'Green Acres Storage', address: '123 Green St', contact: 'info@greenacres.com' },
                        { name: 'Harvest Storage', address: '456 Harvest Rd', contact: 'info@harveststorage.com' },
                    ];

                    facilities.forEach(facility => {
                        const facilityDiv = document.createElement('div');
                        facilityDiv.classList.add('facility');

                        facilityDiv.innerHTML = `
                            <h3>${facility.name}</h3>
                            <p>${facility.address}</p>
                            <p>Contact: ${facility.contact}</p>
                            <button onclick="requestQuotation('${facility.name}')">Request Quotation</button>
                        `;

                        resultsDiv.appendChild(facilityDiv);
                    });
                }, 500);
            } else {
                resultsDiv.innerHTML = '<p>No results found. Please try another location.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            resultsDiv.innerHTML = '<p>There was an error processing your request. Please try again later.</p>';
        });
});

function requestQuotation(facilityName) {
    alert(`Requesting quotation from ${facilityName}`);
}

// Populate the scroll section with featured locations
const featuredLocations = [
    { name: 'Farm Storage 1', imgSrc: 'image1.jpg' },
    { name: 'Farm Storage 2', imgSrc: 'image2.jpg' },
    { name: 'Farm Storage 3', imgSrc: 'image3.jpg' },
    { name: 'Farm Storage 4', imgSrc: 'image4.jpg' },
];

const scrollContainer = document.getElementById('scroll-container');

featuredLocations.forEach(location => {
    const locationDiv = document.createElement('div');
    locationDiv.classList.add('location');

    locationDiv.innerHTML = `
        <img src="${location.imgSrc}" alt="${location.name}">
        <h3>${location.name}</h3>
    `;

    scrollContainer.appendChild(locationDiv);
});
