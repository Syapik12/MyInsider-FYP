<?php
session_start();
include('dbconn.php');
$placeID = $_GET['placeID']; 
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Kellie's Castle</title>
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

        /* Style for the place cards */
        .place-card {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        width: 250px;
        height: 200px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 35px 80px rgba(0, 0, 0, 0.15);
        transition: 0.5s;
        pointer-events: all;
        }

        .place-card:hover {
        height: 200px;
        }

        .place-card .imgBx{
            position: absolute;
            top: 20px;
            width: 200px;
            height: 120px;
            background: #333;
            border-radius: 12px;
            overflow: hidden;
            transition: 0.5s;
        }

        .place-card:hover .imgBx{
            top: -50px;
            scale: 0.75;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.2);
        }

        .place-card .imgBx img{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .place-card .content{
            position: absolute;
            top: 152px;
            width: 100%;
            padding: 0 30px;
            height: 25px;
            overflow: hidden;
            text-align: center;
            transition: 0.5s;
        }

        .place-card:hover .content{
            top: 90px;
            height: 100px;
        }

        .place-card .content h2{
            font-size: 1.5em;
            font-weight: 700;
        }

        .place-card .content p{
            color: #333;
        }

        .place-card .content a{
            position: relative;
            top: 15px;
            display: inline-block;
            padding: 12px 25px;
            background: #d5bdaf;
            color: #fff;
            font-weight: 500;
            text-decoration: none;
        }

        .card-container h1{
            margin-bottom: 20px;
        }

        .imgBx{
            position: relative;
            width: 300px;
            height: 220px;
            background: #333;
            border-radius: 12px;
            transition: 0.5s;
        }

        .imgBx img{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content{
            top: 252px;
            width: 300px;
            text-align: center;
            transition: 0.5s;
        }

        .content h2{
            font-size: 1.5em;
            font-weight: 700;
        }

        .content p{
            color: #333;
        }

        .content a{
            position: relative;
            display: inline-block;
            padding: 12px 25px;
            background: #d5bdaf;
            color: #fff;
            font-weight: 500;
            text-decoration: none;
        }

        .infoBox {
            text-align: center;
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

        .wrapper {

            text-align: center;
            }

            .wrapper a{

              text-decoration: none;
              color: #000;
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
                  <source src="https://firebasestorage.googleapis.com/v0/b/charismatic-fx-399402.appspot.com/o/bg3.mp4?alt=media&token=d3f91802-993a-4f84-814f-79d12d1fa57a" type="video/mp4">
                  Your browser does not support the video tag.
              </video>
          </div>
          <div class="place-details">
            <div class="place-title">
              <h1 id="place-title">Kellie's Castle</h1>
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
                        <p class="place-location">Location: Batu Gajah, Perak, Malaysia</p>
                  </div>
              </div>
            </div>

              <div class="gallery" id="place-gallery">
                <img src="./lib/kellie1.jpg" class="gallery-img-1">
                <img src="./lib/kellie2.jpg">
                <img src="./lib/kellie3.jpg">
                <img src="./lib/kellie4.jpg">
                <img src="./lib/kellie5.jpg">
              </div>
              <div class="description">
                  <h2>Kellie's Castle, The Unfinished Splendor</h2>
              </div>
              <hr class="line">
              <ul class="details-list">
                  <li><i class="fa-solid fa-archway"></i>Moghul Palace Design
                      <span>Distinctive Moghul palace-inspired architecture in Southeast Asia, blending diverse influences.</span>
                  </li>
                  <li><i class="fa-solid fa-l"></i>Construction by Skilled Workers from Madras
                      <span>Madras craftsmen brought an international touch to Kellie's Castle construction.</span>
                  </li>
                  <li><i class="fa-solid fa-trowel-bricks"></i>Underground Room and Secret Tunnel
                      <span>Underground room, secret tunnel defy typical residential norms.</span>
                  </li>
                  <li><i class="fa-solid fa-image"></i>First Elevator in Malaya
                      <span>First Malayan elevator, symbolizing Smith's modern estate vision.</span>
                  </li>
              </ul>

              <hr class="line">

              <p class="home-desc">Kellie's Castle, also known as Kellas House, was constructed in 1905 by prominent Scottish rubber plantation owner William Kellie Smith. 
                The three-story building was designed in the style of a Mughal palace in Agra, India, with craftsmen brought in specifically from Madras.
              
              <br><br>
            
              Originally from the village of Kellas in Scotland, Smith arrived in Malaya (now Malaysia) in 1890. Partnering with landowner Alma Baker, 
              he ventured into rubber cultivation and tin mining, amassing considerable wealth. Smith later returned to Scotland, 
              married his Scottish sweetheart Agnes in 1903, and brought her to Malaya. The couple was blessed with a daughter named Helen in 1904, 
              but it took several more years before Agnes gave birth to a son, Anthony, in 1915.

              <br><br>

              In celebration of Anthony's birth, William Smith decided to expand his residence, planning a grand castle named Kellas House after his Scottish home. 
              The castle featured 14 rooms, an underground chamber, and a secret tunnel, along with the first elevator in Malaya. 
              The second floor was designated for a cement-floored tennis court.

              <br><br>

              The construction, highlighted as the most unique in the Far East, gained attention when reported in the London Financer newspaper on September 15, 1911. 
              Unfortunately, Kellie Smith passed away in Lisbon, Portugal, on December 11, 1926, before the completion of the castle. 
              The unfinished but intriguing structure has since become a popular attraction in Batu Gajah, drawing visitors to witness its distinctive charm.
              </p>

              <hr class="line">

              <div class="map-container">
                <h3>Location on map</h3>
                <div id="map">
                </div>
                <b>Batu Gajah, Perak, Malaysia</b>
                <p>Town near Ipoh, home to Sultan Azlan.</p>
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
                  <div class="wrapper">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) : ?>
                        <!-- Display the comment box if the user is logged in -->
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
                                <input type="hidden" name="placeID" value="<?php echo htmlspecialchars($placeID); ?>">
                                <button type="submit" class="comment-submit">Comment</button>
                            </form>
                        </div>
                    <?php else : ?>
                        <!-- Display a message asking the user to sign in if they're not logged in -->
                        <p style="text-align: center;">Please sign in first to leave a comment</p>
                        <a href="signin.html" class="btn">Sign In</a>
                    <?php endif; ?>
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
        lat: perakMarkers[2].lat,
        lng: perakMarkers[2].lng,
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