<?php
session_start();
include('dbconn.php');

        $sql = "SELECT placeID, rating FROM review";
        $result = $conn->query($sql);

        $ratings = array();

        // Fetch ratings from the result set
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ratings[] = $row;
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyInsider Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="style.css" rel="stylesheet"> 
    <script>
    // Output the PHP $ratings array as a JavaScript variable
    var ratings = <?php echo json_encode($ratings); ?>;
    </script>
    <style>
        /* Additional CSS for custom styling */
        body {
            margin: 0;
            padding: 0;
        }

        .container{
            padding: 0 7%;
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
        <video class="video-slide active" src="https://firebasestorage.googleapis.com/v0/b/charismatic-fx-399402.appspot.com/o/bg1.mp4?alt=media&token=d30c6b12-fd8f-4c96-93e2-35bdaf64a1d2" autoplay muted loop></video>
        <video class="video-slide" src="https://firebasestorage.googleapis.com/v0/b/charismatic-fx-399402.appspot.com/o/bg2.mp4?alt=media&token=93819ce2-d8d3-453f-ac78-7a3586f63868" autoplay muted loop></video>
        <video class="video-slide" src="https://firebasestorage.googleapis.com/v0/b/charismatic-fx-399402.appspot.com/o/bg3.mp4?alt=media&token=d3f91802-993a-4f84-814f-79d12d1fa57a" autoplay muted loop></video>
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
            <h2 class="sub-title">Trending Places</h2>
            <div class="exclusives">
                <div class="exclusive-item">
                    <img src="./lib/img1.jpg">
                    <span>
                        <h3>Jalan Kee Ann</h3>
                        <p>Malacca</p>
                    </span>
                </div>
            </div>
            <div class="cta">
            <h3>Embark on Your Next Adventure</h3>
            <p>Your Journey Starts Here!</p>
            </div>

            <h2 class="sub-title">Malaysia's Stories</h2>
            <div class="stories">
                <div>
                    <img src="./lib/story1.jpg">
                    <p>Historic square where independence was proclaimed, uniting Malaysia.</p>
                </div>
                <div>
                    <img src="./lib/story2.jpg">
                    <p>Mist-kissed hills, tea plantations. Cameron charm, nature's sanctuary in Malaysia.</p>
                </div>
                <div>
                    <img src="./lib/story3.jpg">
                    <p>Sandy shores whispered tales, where Port Dickson's secrets unfold gracefully</p>
                </div>
            </div>

            <div class="about-msg">
                <h2>About MyInsider</h2>
                <p>
                Welcome to MyInsider, your gateway to unlocking the vibrant beauty, rich culture, 
                and captivating history of Malaysia. Founded with a passion for enhancing travel experiences, 
                we aim to revolutionize the way you explore this diverse and enchanting country.
                Our mission is to empower travelers from around the world to discover the wonders of Malaysia effortlessly. 
                We believe that every journey should be seamless, informative, and personalized, 
                ensuring that you make the most of your time in this beautiful nation.
                </p>
            </div>

            <div class="footer">
                <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a href="facebook.com"><i class="fab fa-youtube"></i></a>
                <a href="facebook.com"><i class="fab fa-twitter"></i></a>
                <a href="facebook.com"><i class="fab fa-linkedin-in"></i></a>
                <a href="facebook.com"><i class="fab fa-instagram"></i></a>
                <hr>
                <p>Copyright © 2023, MyInsider</p>
            </div>
        </div>

        

    
    <script src="script.js"></script>
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

        // Add a ratings property to each perakMarkers object
        perakMarkers.forEach(function (marker) {
        var ratingData = ratings.find(function (rating) {
            return rating.placeID === marker.placeID;
        });

        marker.rating = ratingData ? ratingData.rating : 0;
        });

        // Sort perakMarkers based on ratings in descending order
        perakMarkers.sort(function (a, b) {
        return b.rating - a.rating;
        });

        // Update the HTML to display the exclusive items
        var exclusiveItemsContainer = document.querySelector('.exclusives');
        exclusiveItemsContainer.innerHTML = '';

        for (var i = 0; i < Math.min(5, perakMarkers.length); i++) {
        var exclusiveItem = document.createElement('div');
        exclusiveItem.className = 'exclusive-item';

        var img = document.createElement('img');
        img.src = perakMarkers[i].images[0];

        var span = document.createElement('span');
        var h3 = document.createElement('h3');
        h3.textContent = perakMarkers[i].name;

        var p = document.createElement('p');
        p.textContent = perakMarkers[i].city;

        span.appendChild(h3);
        span.appendChild(p);

        exclusiveItem.appendChild(img);
        exclusiveItem.appendChild(span);

        exclusiveItemsContainer.appendChild(exclusiveItem);
        }
    </script>
</body>
</html>