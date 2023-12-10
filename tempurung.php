<?php
session_start();
include('dbconn.php');
$placeID = $_GET['placeID']; 
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Muzium Perak</title>
      <link href="style.css" rel="stylesheet"> 
    </head>
      <script src="https://kit.fontawesome.com/3a97e832b5.js" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <style>
        body{
            background: #fff;
        }

        #map {
            width: 100%;
            height: 77vh;
            margin-bottom: 30px;
            }

        .map-container {
        position: relative;
        }

        .map-container h3{
          font-size: 26px;
          font-weight: 500;
          margin-bottom: 30px;
        }

        .map-container b{
          display: block;
          margin-bottom: 16px;
        }

        /* Style for star rating container */
        .star-rating {
            display: flex;
            margin-bottom: 10px;
        }

        /* Style for star rating radio buttons */
        .star-rating input[type="radio"] {
            display: none; /* Hide the default radio buttons */
        }

        .star-rating label {
            font-size: 24px; /* Adjust the size of the stars */
            color: #ccc; /* Default color for inactive stars */
            cursor: pointer;
            margin-right: 5px; /* Adjust spacing between stars */
        }

        .star-rating input[type="radio"]:checked + label {
            color: #ffd700; /* Color for active stars (yellow in this example) */
        }

        /* Add this CSS in your stylesheet */
        .star-rating label.glow {
            color: #ffd700; /* Color for glowing stars (yellow in this example) */
        }

        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1000;
        }

        .video-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(214, 204, 194, 0.2);
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the video covers the entire container */
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
        <?php
        $placeID = $_GET['placeID']; // Assuming you're passing the Place ID through a URL parameter

        // Query to get average rating and count of reviews for a specific placeID
        $avgRatingQuery = "SELECT AVG(Rating) AS AvgRating, COUNT(*) AS ReviewCount 
                          FROM review 
                          WHERE PlaceID = $placeID";
        $avgRatingResult = $conn->query($avgRatingQuery);

        // Check if there are results
        if ($avgRatingResult->num_rows > 0) {
            $avgRatingRow = $avgRatingResult->fetch_assoc();
            $averageRating = round($avgRatingRow['AvgRating'], 1); // Round to 1 decimal place
            $reviewCount = $avgRatingRow['ReviewCount'];
        } else {
            $averageRating = 0; // Default value if no reviews
            $reviewCount = 0;
        }
        ?>
        <div class="container">
          <div class="video-container">
              <video autoplay muted loop>
                  <source src="./lib/bg3.mp4" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
          </div>
          <div class="place-details">
            <div class="place-title">
              <h1 id="place-title">Tempurung Cave</h1>
              <div class="row">
                  <div>
                      <!-- Dynamic Star Rating -->
                      <?php
                      for ($i = 1; $i <= 5; $i++) {
                          if ($i <= $averageRating) {
                              echo '<i class="fas fa-star"></i>';
                          } elseif ($i - 0.5 == $averageRating) {
                              echo '<i class="fas fa-star-half-alt"></i>';
                          } else {
                              echo '<i class="far fa-star"></i>';
                          }
                      }
                      ?>
                      <span><?php echo $reviewCount . ' Reviews'; ?></span>
                  </div>
                  <div>
                        <p class="place-location">Location: Gopeng, Perak, Malaysia</p>
                  </div>
              </div>
            </div>

              <div class="gallery" id="place-gallery">
                <img src="./lib/tempurung1.jpg" class="gallery-img-1">
                <img src="./lib/tempurung2.jpg">
                <img src="./lib/tempurung3.jpg">
                <img src="./lib/tempurung4.jpg">
                <img src="./lib/tempurung5.jpg">
              </div>
              <div class="description">
                  <h2>Tempurung Cave, Malaysia's Majestic Limestone Cave and Historical Landmark</h2>
              </div>
              <hr class="line">
              <ul class="details-list">
                  <li><i class="fa-solid fa-archway"></i>Distinctive Dome-like Chambers
                      <span>Five domed chambers with unique stalactite formations, captivating visitors aesthetically.</span>
                  </li>
                  <li><i class="fa-solid fa-l"></i>Varied Environmental Conditions
                      <span>Offer diverse environments for spelunkers and tourists.</span>
                  </li>
                  <li><i class="fa-solid fa-trowel-bricks"></i>Historical Significance
                      <span>Communist hideout (1950-60) and tin mining site (1970s). Historical significance.</span>
                  </li>
                  <li><i class="fa-solid fa-image"></i>Adaptations for Tourism
                      <span>Perak enhances Tempurung Cave with amenities, safety measures, and guided activities.</span>
                  </li>
              </ul>

              <hr class="line">

              <p class="home-desc">Gua Tempurung, located in Gopeng, Perak, Malaysia, is a limestone cave known for its coconut shell-shaped formations. 
                Stretching 1.9 km and believed to exist since 8000 BC, the cave features five large domes with unique stalagmites and stalactites. 
                Each dome differs in temperature, water levels, limestone, and marble content. A popular tourist attraction, 
                it is one of the largest limestone caves in Peninsular Malaysia.
              
              <br><br>
            
              Situated 24 km south of Ipoh and a 15-minute drive from the renowned kayaking spot, Sungai Kampar, 
              Gua Tempurung captivates visitors with its natural beauty. The cave, adorned with lights, stairs, walkways, and public facilities, 
              is well-preserved by the Perak state government to enhance the visitor experience. Adventurous activities like river trekking are also organized.

              <br><br>

              Beyond its natural wonders, Gua Tempurung holds historical significance as a former communist hideout in the 1950s-1960s and later served as a 
              tin mining site from the 1970s. Easily accessible via the North-South Expressway or federal roads, the cave attracts tourists and explorers alike.

              <br><br>

              Additionally, a medical university, costing RM450 million and spanning 100 hectares, is set to be established near Gua Tempurung in Gopeng. 
              Expected to be completed in 2009, the university is a collaborative effort between the Perak state government, Blair Education Services Sdn Bhd, 
              and five Indian universities, offering courses in dentistry, pharmacy, nursing, information technology, biotechnology, nano-technology, geosciences, and management.
              </p>

              <hr class="line">

              <div class="map-container">
                <h3>Location on map</h3>
                <div id="map">
                </div>
                <b>Gopeng, Perak, Malaysia</b>
                <p>Town in Perak, Malaysia, 20 km south of Ipoh capital.</p>
              </div>

              <hr class="line">

              <div class="comment-session">
                <div class="post-comment">
                <?php
                // Function to calculate the time difference in a human-readable format
                function timeElapsed($timestamp) {
                  $datetime = new DateTime($timestamp, new DateTimeZone('Asia/Kuala_Lumpur')); 
                  $now = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
                  $interval = $now->diff($datetime);

                  if ($interval->y > 0) {
                      return $interval->y . ' years ago';
                  } elseif ($interval->m > 0) {
                      return $interval->m . ' months ago';
                  } elseif ($interval->d > 0) {
                      return $interval->d == 1 ? 'yesterday' : $interval->d . ' days ago';
                  } elseif ($interval->h > 0) {
                      return $interval->h == 1 ? $interval->h . ' hour ago' : $interval->h . ' hours ago';
                  } elseif ($interval->i > 0) {
                      return $interval->i == 1 ? $interval->i . ' minute ago' : $interval->i . ' minutes ago';
                  } else {
                      return 'just now';
                  }
                }
                // Query to get comments from the database
                // Query to get comments from the database
                $sql = "SELECT user.Username, review.Rating, review.Comment, review.Review_Date, user.image_name, user.image_data 
                        FROM user 
                        INNER JOIN review ON user.UserID = review.UserID
                        WHERE review.PlaceID = $placeID";
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="comment-list">
                                <div class="flex">
                                  <div class="user">
                                    <div class="user-image"><img src="data:image/jpeg;base64,'.base64_encode($row['image_data']).'" alt="'.$row['image_name'].'"></div>
                                    <div class="user-meta">
                                      <div class="name">' . $row['Username'] . '</div>
                                      <div class="day">' . timeElapsed($row['Review_Date']) . '</div>
                                    </div>
                                  </div>
                                  <div class="reply">';
                                  // Output stars based on the Rating value
                                  for ($i = 1; $i <= 5; $i++) {
                                      if ($i <= $row['Rating']) {
                                          echo '<i class="fas fa-star"></i>';
                                      } elseif ($i - 0.5 == $row['Rating']) {
                                          echo '<i class="fas fa-star-half-alt"></i>';
                                      } else {
                                          echo '<i class="far fa-star"></i>';
                                      }
                                  }

                                  echo '</div>
                                          </div>
                                          <div class="comment">' . $row['Comment'] . '</div>
                                        </div>';
                              }
                } else {
                    echo "No comments found";
                }
                
                ?>
                  <div class="comment-box">
                    <form action="submit_comment.php" method="post">
                        <div class="user">
                            <div class="image"><img src="data:image/jpeg;base64,<?php echo base64_encode($_SESSION['image_data']); ?>" alt="<?php echo $_SESSION['image_name']; ?>"></div>
                            <div class="name"><?php echo strtoupper($_SESSION['Username']); ?></div>
                        </div>
                        <div class="star-rating">
                            <input type="radio" name="rating" value="1" id="rating1"><label for="rating1"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="2" id="rating2"><label for="rating2"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="3" id="rating3"><label for="rating3"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="4" id="rating4"><label for="rating4"><i class="fas fa-star"></i></label>
                            <input type="radio" name="rating" value="5" id="rating5"><label for="rating5"><i class="fas fa-star"></i></label>
                        </div>
                        <textarea name="comment" required></textarea>
                        <button type="submit" class="comment-submit">Comment</button>
                    </form>
                </div>
                </div>
              </div>
            </div>
        </div>
    </body>
    <script src="script.js"></script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7pdXIZgff_5nHTauJwJP4GJ1CL0NHGdU&libraries=geometry&callback=initMapNoCard">
    </script>
    <script>
      // Initialize the map
function initMapNoCard() {
  // Try to get the user's location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      var placeLatLng = {
        lat: perakMarkers[3].lat,
        lng: perakMarkers[3].lng,
      };

      // Map options
      mapOptions = {
        center: placeLatLng, // Center the map on the placeLatLng
        zoom: 12, // Set the zoom level
        styles: [
          {
            featureType: "poi",
            elementType: "labels",
            stylers: [{ visibility: "off" }],
          },
          {
            featureType: "road",
            elementType: "labels",
            stylers: [{ visibility: "off" }],
          },
          // Add more style rules to customize the map as needed
        ],
      };

      // Create the map
      map = new google.maps.Map(document.getElementById('map'), mapOptions);

      // Define a custom icon for the user's location marker
      var userIcon = {
        url: './lib/user.png', // Provide the path to your custom icon
        scaledSize: new google.maps.Size(40, 40), // Adjust the icon size as needed
      };

      // Add a marker for the user's location
      var userMarker = new google.maps.Marker({
        position: userLatLng,
        map: map,
        title: 'Your Location',
        icon: userIcon,
      });

      // Create an InfoWindow with the "You are Here" text
      var infoWindow = new google.maps.InfoWindow({
        content: 'You are Here'
      });
      // Loop through all the custom markers and add them to the map
      for (var i = 0; i < perakMarkers.length; i++) {
        addMarkerWithInfoWindow(map, perakMarkers[i]);
      }
    });
  }
}

    $(document).ready(function() {
        $('.star-rating input[type="radio"]').on('change', function() {
            var selectedRating = parseInt($(this).val());

            // Remove glow from all stars
            $('.star-rating label').removeClass('glow');

            // Add glow to selected stars and all stars before it
            $('.star-rating label:lt(' + selectedRating + ')').addClass('glow');
        });
    });


    </script>
</html>