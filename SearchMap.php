<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="style.css" rel="stylesheet"> 
    <title>Google Map Demo</title>
    <script src="https://kit.fontawesome.com/3a97e832b5.js" crossorigin="anonymous"></script>
    <style>
        body{
            background: #d5bdaf;
        }
        #map {
            width: 100%;
            height: 77vh;
            }

        .map-container {
        position: relative;
        }
        
        .card-container{
            padding-left: 0%;
            margin: 2%;
            margin-top: 100px;
        }

        .bottom-container{
            position: absolute;
            display: grid;
            gap: var(--size-3);
            grid-auto-flow: column;
            grid-auto-columns: 270px;
            bottom: 0;
            left: 0;
            width: 96%;
            max-height: 420px;
            padding: 40px 20px;
            pointer-events: none;
            overflow-x: auto; /* Enable horizontal scrolling if needed */
            overscroll-behavior-inline: contain;
        }

        .bottom-container::-webkit-scrollbar{
            width: 0;
        }

        .snaps-inline{
            scroll-snap-type: inline mandatory;
            scroll-padding-inline: var(--size-3, 1rem);
        }

        .snaps-inline > *{
            scroll-snap-align: start;
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

        /* Style for the "Nearby" button */
        #nearby-button {
        padding: 10px 20px;
        background-color: #e3d5ca; /* Change the background color as needed */
        color: black; /* Change the text color as needed */
        border: none;
        margin-right: 5px;
        border-radius: 5px;
        font-size: 16px; /* Adjust the font size as needed */
        cursor: pointer;
        }

        /* Hover effect for the "Nearby" button */
        #nearby-button:hover {
        background-color: #d5bdaf; /* Change the hover background color as needed */
        }

        #show-all-button {
            padding: 10px 20px;
            background-color: #c6ac8f; /* Change the background color as needed */
            color: white; /* Change the text color as needed */
            border: none;
            border-radius: 5px;
            font-size: 16px; /* Adjust the font size as needed */
            cursor: pointer;
        }

        #show-all-button:hover {
            background-color: #5e503f; /* Change the hover background color as needed */
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
    <div class="video-container">
        <video autoplay muted loop>
            <source src="./lib/bg3.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="card-container">
        <div class="search-container">
            <div class="row">
                <input type="text" class="search-bar" placeholder="Search..." autocomplete="off">
                <button id="search-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                <div class="column">
                    <button id="nearby-button">Nearby</button>
                    <button id="show-all-button" style="display: none;">Show All</button>
                    <input type="text" id="custom-threshold" placeholder="Input range here (10000m = 10km)" autocomplete="off">
                </div>
            </div>
            <div class="result-box">
            </div>
            <div class="map-result-container">
                <div class="map-container">
                    <div id="map"></div>
                    <div class="bottom-container snaps-inline" id="bottom-bar">
                      <!-- Cards for places will go here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7pdXIZgff_5nHTauJwJP4GJ1CL0NHGdU&libraries=geometry&callback=initMap">
    </script>
    <script src="script.js"></script>
    
    
</body>
</html>
