<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Muzium Perak</title>
      <link href="style.css" rel="stylesheet"> 
    </head>
      <script src="https://kit.fontawesome.com/3a97e832b5.js" crossorigin="anonymous"></script>
      <style>
        body{
            background-color: #fff;
        }
    </style>
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
        <div class="place-details">
            <div class="place-title">
              <h1 id="place-title">Sultan Azlan Shah Galeri</h1>
              <div class="row">
                <div>
                  <!-- Review system -->
                </div>
                <div>
                  <p id="place-location">Location: San Francisco, California, United States</p>
                </div>
              </div>
            </div>
            <div class="gallery" id="place-gallery">
              <!-- Images will be dynamically inserted here -->
            </div>
            <div class="description">
                <h2>Sultan Azlan Shah Galeri, A remarkable places</h2>
                <p>2 guest &nbsp; &nbsp; 2 beds &nbsp; &nbsp; 1 bathroom</p>
                <h4>$ 100 / day</h4>
            </div>
            <hr class="line">
            <ul class="details-list">
                <li><i class="fa-solid fa-house"></i>Entire Home
                    <span>You will have the entire flat for you.</span>
                </li>
                <li><i class="fa-solid fa-paintbrush"></i>Enhanced Clean
                    <span>This host has committed to myInsider</span>
                </li>
                <li><i class="fa-solid fa-location-dot"></i>Great Location
                    <span>90% of recent guest gave the location a 5 star rating</span>
                </li>
                <li><i class="fa-solid fa-heart"></i>Great Check-in Experience
                    <span>100% of recent guest gave the Check-in process a 5 star rating </span>
                </li>
            </ul>

            <hr class="line">

            <p class="home-desc">isoalkdhawljkdhawjkdhsajkdhawjkkjfsabkjasflkawjfkjasfakwjbdkjwbakedjbwakjdb</p>

            <hr class="line">

            <div id="map">

            </div>
          </div>
    </body>
    
    
    <script src="script.js"></script>
    <script>
        //Function to populate place details
        function populatePlaceDetails(marker) {
        // Get references to HTML elements
        var placeTitle = document.getElementById('place-title');
        var placeLocation = document.getElementById('place-location');
        var placeGallery = document.getElementById('place-gallery');

        // Populate the HTML elements with marker data
        placeTitle.textContent = marker.name;
        placeLocation.textContent = 'Location: ' + marker.city;

        // Create image elements for the gallery
        marker.images.forEach(function (imageSrc, index) {
          var imageElement = document.createElement('img');
          imageElement.src = imageSrc;

          // Add a class to the first image
          if (index === 0) {
            imageElement.classList.add('gallery-img-1');
          }

          placeGallery.appendChild(imageElement);
        });
        placeMap(marker);
      }


      // Call the function to populate the place details for a specific marker
      populatePlaceDetails(perakMarkers[0]); // Example: Populate details for the first marker


      // Function to initialize and display the small map
      function placeMap(marker) {
        // Get the location data
        var location = {
            lat: marker.latitude,
            lng: marker.longitude
        };

        // Create a map centered on the location
        var map = new google.maps.Map(document.getElementById('map'), {
            center: location,
            zoom: 15 // You can adjust the zoom level as needed
        });

        // Create a marker on the map
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: marker.name
        });
    }
    </script>
</html>