document.getElementById('dashboard').addEventListener('click', function() {
    showSection('dashboard-section');
});

document.getElementById('manage-facilities').addEventListener('click', function() {
    showSection('manage-facilities-section');
});

document.getElementById('user-requests').addEventListener('click', function() {
    showSection('user-requests-section');
});

function showSection(sectionId) {
    document.getElementById('dashboard-section').classList.add('hidden');
    document.getElementById('manage-facilities-section').classList.add('hidden');
    document.getElementById('user-requests-section').classList.add('hidden');
    document.getElementById(sectionId).classList.remove('hidden');
}

// Remove or comment out example data
// let facilities = [
//     { name: 'Green Acres Storage', address: '123 Green St', contact: 'info@greenacres.com', imgSrc: 'image1.jpg' },
//     { name: 'Harvest Storage', address: '456 Harvest Rd', contact: 'info@harveststorage.com', imgSrc: 'image2.jpg' },
// ];

// let requests = [
//     { user: 'John Doe', facility: 'Green Acres Storage', date: '2024-06-17' },
//     { user: 'Jane Smith', facility: 'Harvest Storage', date: '2024-06-18' },
// ];

document.getElementById('facility-count').textContent = facilities.length;
document.getElementById('request-count').textContent = requests.length;

function renderFacilities() {
    const facilitiesList = document.getElementById('facilities-list');
    facilitiesList.innerHTML = '';
    facilities.forEach((facility, index) => {
        const facilityDiv = document.createElement('div');
        facilityDiv.classList.add('facility');
        
        facilityDiv.innerHTML = `
            <img src="${facility.imgSrc}" alt="${facility.name}">
            <div>
                <h3>${facility.name}</h3>
                <p>${facility.address}</p>
                <p>Contact: ${facility.contact}</p>
                <button onclick="editFacility(${index})">Edit</button>
                <button onclick="deleteFacility(${index})">Delete</button>
            </div>
        `;
        
        facilitiesList.appendChild(facilityDiv);
    });
}

function renderRequests() {
    const requestsList = document.getElementById('requests-list');
    requestsList.innerHTML = '';
    requests.forEach(request => {
        const requestDiv = document.createElement('div');
        requestDiv.classList.add('request');
        
        requestDiv.innerHTML = `
            <p>User: ${request.user}</p>
            <p>Facility: ${request.facility}</p>
            <p>Date: ${request.date}</p>
        `;
        
        requestsList.appendChild(requestDiv);
    });
}

// Comment out or remove this function to handle form submission via the server
// function addFacility(event) {
//     event.preventDefault();
//     const name = document.getElementById('facility-name').value;
//     const address = document.getElementById('facility-address').value;
//     const contact = document.getElementById('facility-contact').value;
//     const imgSrc = URL.createObjectURL(document.getElementById('facility-image').files[0]);
    
//     facilities.push({ name, address, contact, imgSrc });
//     document.getElementById('facility-count').textContent = facilities.length;
//     renderFacilities();
//     document.getElementById('add-facility-form').reset();
// }

function editFacility(facilityId) {
    window.location.href = `/storage-facilities/${facilityId}/info_edit`;
}

function deleteFacility(index) {
    facilities.splice(index, 1);
    document.getElementById('facility-count').textContent = facilities.length;
    renderFacilities();
}

// Ensure form submission is handled by the backend
document.getElementById('add-facility-form').addEventListener('submit', function(event) {
    // Allow the form to be submitted to the server
});



// Remove these calls to avoid using example data
// renderFacilities();
// renderRequests();
