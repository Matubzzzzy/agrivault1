document.getElementById('profile-picture').addEventListener('click', function() {
    document.getElementById('upload-modal').style.display = 'block';
});

document.querySelector('.close-button').addEventListener('click', function() {
    document.getElementById('upload-modal').style.display = 'none';
});

document.getElementById('save-picture').addEventListener('click', function() {
    const fileInput = document.getElementById('upload-picture');
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profile-picture').src = e.target.result;
            document.getElementById('upload-modal').style.display = 'none';
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
});

document.getElementById('change-password-button').addEventListener('click', function() {
    window.location.href = 'change-password.html';
});

// Close the modal if user clicks outside of it
window.onclick = function(event) {
    const modal = document.getElementById('upload-modal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
