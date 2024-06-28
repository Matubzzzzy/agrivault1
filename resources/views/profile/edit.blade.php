<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Page</title>
    <link rel="stylesheet" href="{{ asset('user_profile_styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .profile-picture-section {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-picture {
            width: 150px;  /* Set the width to the desired size */
            height: 150px; /* Set the height to the desired size */
            border-radius: 50%; /* Make it a circle */
            object-fit: cover;  /* Ensure the image covers the area */
            object-position: center; /* Center the image */
            overflow: hidden; /* Ensure the image does not overflow */
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-left">
                <span class="company-name">AgriVault</span>
                <a href="#" onclick="history.back(); return false;" class="navbar-link">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            <a class="navbar-link" href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-header">
            <h1>User Profile</h1>
        </div>
        <div class="profile-picture-section">
            <div class="profile-picture-wrapper">
            @if(Auth::user()->profile_picture)
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-picture">
        @else
            <p><img src="{{ asset('default_icon.jpg') }}"></p>
        @endif
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800">

        <form class="profile-info" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
        
        <div>
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" name="profile_picture" id="profile_picture">
        </div>

        <br>    
            <div class="mb-4">
                 <x-input-label for="name" :value="__('Name')" />
                 <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                 <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        

        <div class="profile-actions">
            <div class="flex items-center justify-end mt-4">
            <button type="submit">Update Profile</button>
                
            </div>
        </div>
        </form>
    </div>

    <!-- Modal for uploading profile picture -->
    <!-- <div id="upload-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Upload Profile Picture</h2>
            <input type="file" id="upload-picture" accept="image/*">
            <button id="save-picture">Save</button>
        </div>
    </div> -->
    </div>
    </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p>Company Name: AgriVault</p>
            <p>Contact: contact@agrivault.com</p>
            <p>Phone: +1-800-555-1234</p>
            <p>Address: 456 Corporate Blvd, Business City, USA</p>
        </div>
    </footer>

    <script src="user_profile_scripts.js"></script>
</body>
</html>
