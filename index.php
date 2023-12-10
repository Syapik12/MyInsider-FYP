<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyInsider Landing Page</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="style.css" rel="stylesheet"> 
    <style>
        /* Additional CSS for custom styling */
        body {
            margin: 0;
            padding: 0;
        }


        /* Style for the video container */
        #bg-video {
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh; /* Adjust the height as needed */
            object-fit: cover; /* Maintain aspect ratio and crop video */
            z-index: 1; /* Ensure video is below content and navbar */
        }

        .new-section {
            background-color: #fff;
            padding: 50px 0; /* Add padding to create space between sections */
            height: 50vh; /* Adjust the height as needed */
            overflow: auto; /* Enable scrolling if content exceeds the height */
        }

        /* Style for the map-content section */
        .map-content {
            background-color: #fff;
            padding: 50px 0; /* Add padding to create space between sections */
            height: 50vh; /* Adjust the height as needed */
            overflow: auto; /* Enable scrolling if content exceeds the height */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <header>
        <!-- Logo on the left -->
        <a class="brand" href="index.php"><img src="./lib/logo.png" alt="Logo"></a>
        <div class="menu-btn"></div>
        <!-- Items on the right -->
        <div class="navigation">
            <div class="navigation-items">
                <a href="SearchMap.php">Explore</a>
                <?php

                if (isset($_SESSION['UserID'])) {
                    echo '<a href="signout.php">Sign Out</a>';
                } else {
                    echo '<a href="signin.html">Sign In</a>';
                }
                ?>
            </div>
        </div>
    </header>

    <!-- Content Section -->
    <section class="home">
        <video class="video-slide active" src="./lib/bg1.mp4" autoplay muted loop></video>
        <video class="video-slide" src="./lib/bg2.mp4" autoplay muted loop></video>
        <video class="video-slide" src="./lib/bg3.mp4" autoplay muted loop></video>
        <div class="content active">
            <h1>Malaysia:<br><span>Truly Asia's Hidden Gem!</span></h1>
            <p>Experience the enchantment of Malaysia, a country that perfectly encapsulates the essence of Asia. Nestled in the heart of Southeast Asia, Malaysia is a land of breathtaking landscapes, rich cultural diversity, and unforgettable adventures waiting to be discovered.</p>
            <a href="SearchMap.html">Explore Now!</a>
        </div>
        <div class="content">
            <h1>Discover Malaysia:<br><span>Where Adventure Meets Culture.</span></h1>
            <p>Experience the enchantment of Malaysia, a country that perfectly encapsulates the essence of Asia. Nestled in the heart of Southeast Asia, Malaysia is a land of breathtaking landscapes, rich cultural diversity, and unforgettable adventures waiting to be discovered.</p>
            <a href="#">Explore Now!</a>
        </div>
        <div class="content">
            <h1>Malaysia:<br><span>A Tapestry of Experiences.</span></h1>
            <p>Experience the enchantment of Malaysia, a country that perfectly encapsulates the essence of Asia. Nestled in the heart of Southeast Asia, Malaysia is a land of breathtaking landscapes, rich cultural diversity, and unforgettable adventures waiting to be discovered.</p>
            <a href="#">Explore Now!</a>
        </div>
        <div class="media-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>

    <!-- New Section -->
        <div class="container">
            <h2 class="sub-title">Exclusive</h2>
            <div class="exclusives">
                <div class="exclusive-item">
                    <img src="./lib/img1.jpg">
                    <span>
                        <h3>Jalan Kee Ann</h3>
                        <p>Malacca</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img2.jpg">
                    <span>
                        <h3>Kilim Geoforest Park</h3>
                        <p>Kedah</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img3.jpg">
                    <span>
                        <h3>Cameron Highlands</h3>
                        <p>Pahang</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img4.jpg">
                    <span>
                        <h3>George Town</h3>
                        <p>Penang Island</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img4.jpg">
                    <span>
                        <h3>George Town</h3>
                        <p>Penang Island</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img4.jpg">
                    <span>
                        <h3>George Town</h3>
                        <p>Penang Island</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img4.jpg">
                    <span>
                        <h3>George Town</h3>
                        <p>Penang Island</p>
                    </span>
                </div>
                <div class="exclusive-item">
                    <img src="./lib/img4.jpg">
                    <span>
                        <h3>George Town</h3>
                        <p>Penang Island</p>
                    </span>
                </div>
            </div>
        </div>

    <!-- Link to Bootstrap JS and jQuery (you may need these for Bootstrap functionality) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAywrcL-K6NeKHJivaPghOQIMt3PjVriYs&callback=initMap" async defer></script>
    <!-- JavaScript code to initialize the map -->
    <script>

        //JavaScript for responsive website
        const menuBtn = document.querySelector(".menu-btn");
        const navigation = document.querySelector(".navigation");

        menuBtn.addEventListener("click", () => {
            menuBtn.classList.toggle("active");
            navigation.classList.toggle("active");
        });

        //JavaScript for video slider navigation
        const btns = document.querySelectorAll(".nav-btn");
        const slides = document.querySelectorAll(".video-slide");
        const contents = document.querySelectorAll(".content");

        var sliderNav = function(manual){
            btns.forEach((btn) => {
                btn.classList.remove("active");
            });

            slides.forEach((slide) => {
                slide.classList.remove("active");
            });

            contents.forEach((content) => {
                content.classList.remove("active");
            });

            btns[manual].classList.add("active");
            slides[manual].classList.add("active");
            contents[manual].classList.add("active");
        }

        btns.forEach((btn, i) => {
            btn.addEventListener("click", () => {
                sliderNav(i);
            })
        })

        // JavaScript code to initialize the map
        function initMap() {
            // Set the initial map coordinates and options
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 3.14073089555922, lng: 101.68784422148727 }, // Example coordinates (Kuala Lumpur)
                zoom: 12, // Zoom level
            });

            // Add a marker to the map
            const marker = new google.maps.Marker({
                position: { lat: 3.14073089555922, lng: 101.68784422148727 }, // Example marker position (Kuala Lumpur)
                map: map,
                title: "Kuala Lumpur" // Marker title
            });

            // Add a click event listener to the map
            map.addListener("click", function (event) {
                const latitude = event.latLng.lat();
                const longitude = event.latLng.lng();
                openNavigationApp(latitude, longitude);
            });

            // You can add more markers, polygons, or other features here.
        }

        // Function to open the navigation app
        function openNavigationApp(lat, lng) {
            // Construct the geo URI with the latitude and longitude
            const geoUri = `geo:${lat},${lng}`;

            // Open the link, which should launch the user's navigation app
            window.open(geoUri, '_system');
        }

    </script>
</body>
</html>