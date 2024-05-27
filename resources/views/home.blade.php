<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <link rel="stylesheet" href="{{ asset('/user_homepage_styles.css') }}">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to Your User Homepage</h1>
            <nav>
                <ul>
                    <li><a href="route('profile.show')">Profile</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a></li>
                </ul>
            </nav>
        </header>
        <section class="content">
            <!-- Your main content here -->
            <p>This is your user homepage. You can access your profile or logout from here.</p>
        </section>
    </div>

    <script src="/AgriVault/resources/js/lockscreen.js"></script>
</body>
</html>
