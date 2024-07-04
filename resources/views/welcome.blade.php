<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AgriVault</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/index_styles.css') }}">        
    </head>
    <body>
        <header class="header">
            <nav class="navbar">
                <div class="logo">AgriVault</div>
                <ul class="nav-links">
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="#solutions">Solutions</a></li>
                    <li><a href=".about-section">About us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <div class="menu-icon">
                    <i class="fas fa-bars"></i>
                </div>
            </nav>
        </header>
        <section class="home-section">
            <div class="content">
                <h1>We help connect you to reliable agricultural storage solutions.</h1>
                <p>Join us today and explore a variety of storage options tailored to meet your needs.</p>
                <p>To make a booking, please create an account</p>
                <a href="{{ route('register') }}" class="btn">Start using AgriVault</a>
            </div>
        </section>

        <section class="search-section">
            <h2>Take a look at the locations we are in partnership with.</h2>
            <!-- <h3>To make a booking please create an account</h3>
            <a href="{{ route('register') }}" class="btn">Start using AgriVault</a> -->
    
    <!-- Dropdown menu for locations -->
        <div class="location-dropdown">
            <label for="location">Select Location:</label>
            <select id="location" onchange="filterFacilities(this.value)">
                <option value="">All Locations</option>
                @foreach($locations as $location)
                    <option value="{{ $location }}">{{ $location }}</option>
                @endforeach
            </select>
        </div>

        <div id="facilities-list">
            @if($facilities->isEmpty())
                <p>{{ __('No facilities available.') }}</p>
            @else
                <div class="facilities-container">
                    
                    @foreach($facilities as $facility)
                        <div class="facility" data-location="{{ $facility->county }}">
                            <h3>{{ $facility->name }}</h3>
                            <p>{{ $facility->county }}</p>
                            <p>{{ $facility->description }}</p>
                            <p>Contact: {{ $facility->contacts }}</p>
                            <hr>
                        </div>
                        
                    @endforeach
                    
                </div>
            @endif
        </div>

        </section>

        <section class="about-section">

            <div class="about-content">
                <h2>About Us</h2>
                <p>At AgriVault, our mission is to provide farmers with access to reliable storage solutions. We understand the importance of preserving the quality of agricultural products, and our platform offers a comprehensive directory of storage facilities across various regions. Our goal is to empower farmers by giving them the tools and resources they need to make informed decisions about their storage options.</p>
                <p>Whether you are looking for short-term or long-term storage, AgriVault has a solution for you. Our platform is designed to be user-friendly and accessible, ensuring that farmers can quickly find and connect with the right storage providers.</p>
            </div>
        </section>
        <section class="how-section">
            <div class="how-content">
                <h2>How to Use the Platform</h2>
                <div class="how-steps">
                    <div class="step">
                        <i class="fas fa-user-plus"></i>
                        <h3>Create an Account</h3>
                        <p>Sign up for AgriVault to access our full range of services.</p>
                    </div>
                    <div class="step">
                        <i class="fas fa-search"></i>
                        <h3>Browse Storage Facilities</h3>
                        <p>Explore available storage options tailored to your needs.</p>
                    </div>
                </div>
            </div>
        </section>
        <footer id="agrivault-footer">
            <div class="container">
                <div class="footer-logo">
                    <h2>AgriVault</h2>
                </div>
                <div class="footer-content">
                    <div class="footer-column">
                        <h3>Follow us</h3>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="footer-column">
                        <h3>Our Services</h3>
                        <ul>
                            <li><a href="#">Storage Solutions</a></li>
                            <li><a href="#">Inventory Management</a></li>
                            <li><a href="#">Logistics</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>About Us</h3>
                        <ul>
                            <li><a href="#">Our Story</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">Careers</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Resources</h3>
                        <ul>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Support</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3>Contact</h3>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Email: info@agrivault.com</a></li>
                            <li><a href="#">Phone: +123 456 7890</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>© AgriVault 2024</p>
                    <p>AgriVault HQ - Your City, Your Country. Registered on the Chamber of Commerce: 12345678</p>
                    <div class="footer-links">
                        <a href="#">Cookie Policy</a>
                        <a href="#">Terms & Conditions</a>
                        <a href="#">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            // Add JavaScript here for responsive menu toggle
            const menuIcon = document.querySelector('.menu-icon');
            const navLinks = document.querySelector('.nav-links');

            menuIcon.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });

            function filterFacilities(county) {
                let facilities = document.querySelectorAll('.facility');
        
                facilities.forEach(function(facility) {
                    let dataLocation = facility.getAttribute('data-location');
                    if (county === '' || dataLocation === county) {
                        facility.style.display = 'block';
                    } else {
                        facility.style.display = 'none';
                    }
                });
            }

        </script>
    </body>
</html>
