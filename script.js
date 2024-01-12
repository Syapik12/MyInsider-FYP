var isSuggestionsOpen = false;
var userLatLng;
var map;
// Create an array of custom markers with their latitude, longitude, name, description, and image URL for Perak locations
var perakMarkers = [
  {
    lat: 4.8604172841692135, 
    lng: 100.74537836422999,
    name: 'Perak Museum',
    placeID: "1",
    description: "A remarkable historical gem that transports you back in time to the late 19th century.",
    images: ['./lib/muziumperak1.jpg', './lib/muziumperak2.jpg', './lib/muziumperak3.jpg'],
    detailPageUrl: 'muziumperak.php',
    city: 'Taiping',
  },
  {
    lat: 4.766342167622582,  
    lng: 100.94817157021961,
    name: 'Sultan Azlan Shah Gallery',
    placeID: "2",
    description: "A very spectacular place for tourists and history buffs looking to explore Perak, Malaysia's rich past.",
    images: ['./lib/galerisas1.jpg', './lib/galerisas2.jpg', './lib/galerisas3.jpg'],
    detailPageUrl: 'galerisas.php',
    city: 'Kuala Kangsar'
  },
  {
    lat: 4.475165975035683, 
    lng: 101.08742395722768,
    name: 'Kellie\'s Castle',
    placeID: "3",
    description: 'Popularly referred to as Kellie\'s Folly, it serves as a riveting reminder of a fascinating historical period.',
    images: ['./lib/kellie1.jpg', './lib/kellie2.jpg', './lib/kellie3.jpg'],
    detailPageUrl: 'kellie.php',
    city: 'Batu Gajah'
  },
{
    lat: 4.416008212644528, 
    lng: 101.18768503352229,
    name: 'Tempurung Cave',
    placeID: "4",
    description: 'A captivating natural wonder that entices explorers and nature lovers to delve deeper.',
    images: ['./lib/tempurung1.jpg', './lib/tempurung2.jpg', './lib/tempurung3.jpg'],
    detailPageUrl: 'tempurung.php',
    city: 'Gopeng'
},
{
    lat: 4.852485899010136, 
    lng: 100.7495148469728,
    name: 'Taiping Lake Gardens',
    placeID: "5",
    description: 'The first public garden in the nation, commonly referred to as "Taman Tasik Taiping," is a living reminder of the colonial past that helped build the country.',
    images: ['./lib/lakegarden1.jpg', './lib/lakegarden2.jpg', './lib/lakegarden3.jpg'],
    detailPageUrl: 'lakegarden.php',
    city: 'Taiping'
},
{
    lat: 4.02518432439306, 
    lng: 101.01939548452705,
    name: 'Leaning Tower of Teluk Intan',
    placeID: "6",
    description: 'A unique architectural marvel with a story that spans across generations.',
    images: ['./lib/condong1.jpg', './lib/condong2.jpg', './lib/condong3.jpg'],
    detailPageUrl: 'condong.php',
    city: 'Teluk Intan'
},
{
  lat: 4.5968137495667545,  
  lng: 101.07612949554228,
  name: 'Birch Memorial Clock Tower',
  placeID: "7",
  description: 'Historical charm, cultural panels, iconic architecture.',
  images: ['./lib/birch1.jpg', './lib/birch2.jpg', './lib/birch3.jpg'],
  detailPageUrl: 'birch.php',
  city: 'Ipoh'
},
{
  lat: 4.200536692662573,  
  lng: 100.57581045340676,
  name: 'Dutch Fort',
  placeID: "8",
  description: 'Explore Dutch Fort\'s history, ruins, and scenic coastal charm. Rich heritage!',
  images: ['./lib/dutch1.jpg', './lib/dutch2.jpg', './lib/dutch3.jpg'],
  detailPageUrl: 'dutch.php',
  city: 'Pangkor Island'
},
{
  lat: 4.597383411456581, 
  lng: 101.07344254897025,
  name: 'Ipoh Railway Station',
  placeID: "9",
  description: 'Architectural marvel, heritage hub, scenic transportation landmark.',
  images: ['./lib/railway1.jpg', './lib/railway2.jpg', './lib/railway3.jpg'],
  detailPageUrl: 'railway.php',
  city: 'Ipoh'
},
{
  lat: 4.8131901164387445,  
  lng: 100.67625737353191,
  name: 'Ngah Ibrahim\'s Fort',
  placeID: "10",
  description: 'Step into history at Kota Ngah Ibrahim: trials, heritage, and fortresses.',
  images: ['./lib/ngah1.jpg', './lib/ngah2.jpg', './lib/ngah3.jpg'],
  detailPageUrl: 'ngah.php',
  city: 'Matang'
},
// Add more markers with name, description, and image as needed
];
var map;
var mapOptions;




// Initialize the map
function initMap() {
  // Try to get the user's location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
      userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      // Map options
      mapOptions = {
        center: userLatLng, // Center the map on the user's location
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

      // Open the InfoWindow when the map loads
      infoWindow.open(map, userMarker);

      // Initialize the bottom bar container
      var cardContainer = document.getElementById('bottom-bar');

      // Loop through all the custom markers and add them to the map
      for (var i = 0; i < perakMarkers.length; i++) {
        addMarkerWithInfoWindow(map, perakMarkers[i]);
        addCardToBottomBar(cardContainer, perakMarkers[i]);
      }
    });
  }
}

function addCardToBottomBar(container, markerData) {
  if (userLatLng) {
    // Calculate the distance using the Haversine formula
    var distance = google.maps.geometry.spherical.computeDistanceBetween(
      new google.maps.LatLng(userLatLng.lat, userLatLng.lng),
      new google.maps.LatLng(markerData.lat, markerData.lng)
    );

    // Convert distance to kilometers (rounded to two decimal places)
    var distanceInKilometers = (distance / 1000).toFixed(2);

    var card = document.createElement('div');
    card.className = 'place-card';

    card.innerHTML = `
      <div class="imgBx">
        <img src="${markerData.images[0]}" alt="${markerData.name}" />
      </div>
      <div class="content">
        <h2>${markerData.name}</h2>
        <p>Distance: ${distanceInKilometers} km</p>
      </div>
    `;
    container.appendChild(card);

    card.addEventListener('click', function () {
      openInfoWindowAndCenterMap(markerData);
    });
  }
}

// Keep track of the currently open info window
var currentInfoWindow = null;

// Function to open the info window and center the map on a location with a smooth transition
function openInfoWindowAndCenterMap(markerData) {

  // Create an info window for this marker
  var infoWindow = new google.maps.InfoWindow();

  // Create a div element for the content
  var contentDiv = document.createElement('div');
  contentDiv.className = 'infoBox';

  // Create an "imgBx" div for the image
  var imgBxDiv = document.createElement('div');
  imgBxDiv.className = 'imgBx';

  // Create an image element for the first image
  var imageElement = document.createElement('img');
  imageElement.src = markerData.images[0];
  imageElement.alt = markerData.name;

  // Create a "content" div for the name, description, and read more button
  var contentContentDiv = document.createElement('div');
  contentContentDiv.className = 'content';

  // Create left and right navigation buttons
  var leftArrow = document.createElement('button');
  leftArrow.className = 'arrow left-arrow';
  leftArrow.innerText = '<';

  var rightArrow = document.createElement('button');
  rightArrow.className = 'arrow right-arrow';
  rightArrow.innerText = '>';

  // Initialize the image index
  var currentIndex = 0;

  // Update the InfoWindow content with the current image
  function updateInfoWindowContent() {
    imgBxDiv.innerHTML = ''; // Clear existing content
    imgBxDiv.appendChild(imageElement);

    contentContentDiv.innerHTML = ''; // Clear existing content
    contentContentDiv.innerHTML = `
    <h2>${markerData.name}</h2>
    <p>${markerData.description}</p>
    <a href="${markerData.detailPageUrl}?placeID=${markerData.placeID}" class="read-more-button">Read More</a>
    `;

    // Handle left arrow click
    leftArrow.addEventListener('click', function () {
      currentIndex = (currentIndex - 1 + markerData.images.length) % markerData.images.length;
      imageElement.src = markerData.images[currentIndex];
    });

    // Handle right arrow click
    rightArrow.addEventListener('click', function () {
      currentIndex = (currentIndex + 1) % markerData.images.length;
      imageElement.src = markerData.images[currentIndex];
    });

    contentDiv.appendChild(imgBxDiv);
    contentDiv.appendChild(leftArrow);
    contentDiv.appendChild(rightArrow);
    contentDiv.appendChild(contentContentDiv);

    infoWindow.setContent(contentDiv);
  }

  // Update the InfoWindow content and open it
  updateInfoWindowContent();
  infoWindow.open(map, markerData.marker);

  // Get the marker's position
  var markerPosition = markerData.marker.getPosition();

  // Set an appropriate zoom level (you can adjust this as needed)
  var targetZoom = 12;

  // Smoothly pan and zoom to the marker's position
  map.panTo(markerPosition);
  map.setZoom(targetZoom);

  // Update the currently open info window
  currentInfoWindow = infoWindow;
}


// Function to add a marker with an info window
function addMarkerWithInfoWindow(map, markerData) {
  if (markerData.images && markerData.images.length > 0) {
    var placeIcon = {
      url: './lib/place.png',
      scaledSize: new google.maps.Size(40, 40),
    };

    var marker = new google.maps.Marker({
      position: { lat: markerData.lat, lng: markerData.lng },
      map: map,
      title: markerData.name,
      icon: placeIcon,
    });

    // Attach the marker to the markerData object for later use
    markerData.marker = marker;
    markerData.placeID = markerData.placeID;

    // Add a click event listener to open the info window and center the map
    marker.addListener('click', function () {
      openInfoWindowAndCenterMap(markerData);
    });
  } else {
    console.error('Marker data does not contain images or is empty.');
  }
}

// Function to show nearby markers
function showNearbyMarkers() {
  // Check if geolocation is available
  if (navigator.geolocation) {
    var customThresholdInput = document.getElementById('custom-threshold');
    var customThresholdValue = parseFloat(customThresholdInput.value); // Parse as float for kilometers

    // Check if a valid custom threshold value is provided
    if (isNaN(customThresholdValue) || customThresholdValue <= 0) {
      alert("Please enter a valid positive numeric threshold value in kilometers.");
      return;
    }

    // Convert the threshold value from kilometers to meters
    var threshold = customThresholdValue * 1000;

    navigator.geolocation.getCurrentPosition(function (position) {
      var userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      // Clear the existing map
      map = new google.maps.Map(document.getElementById('map'), mapOptions);

      // Create a user marker
      var userIcon = {
        url: './lib/user.png',
        scaledSize: new google.maps.Size(40, 40),
      };
      var userMarker = new google.maps.Marker({
        position: userLatLng,
        map: map,
        title: 'Your Location',
        icon: userIcon,
      });

      // Clear the existing cards in the bottom bar
      var cardContainer = document.getElementById('bottom-bar');
      cardContainer.innerHTML = '';

      // Loop through the custom markers and check if they are nearby
      for (var i = 0; i < perakMarkers.length; i++) {
        var markerData = perakMarkers[i]; // Retrieve the marker data
        var markerLatLng = {
          lat: markerData.lat,
          lng: markerData.lng
        };

        // Calculate the distance between the user and the marker
        var distance = google.maps.geometry.spherical.computeDistanceBetween(
          new google.maps.LatLng(userLatLng.lat, userLatLng.lng),
          new google.maps.LatLng(markerLatLng.lat, markerLatLng.lng)
        );

        // Check if the distance is within the custom threshold
        if (distance <= threshold) {
          addMarkerWithInfoWindow(map, markerData);
          addCardToBottomBar(cardContainer, markerData, distance);
        }
      }
      // User marker should be visible after nearby markers are added
      userMarker.setMap(map);

      // Handle UI changes
      handleUINearbyButtonClick();
    });
  }
}

// Function to handle UI changes after clicking the "Nearby" button
function handleUINearbyButtonClick() {
  // Hide the nearby button and threshold input
  var nearbyButton = document.getElementById('nearby-button');
  var customThresholdInput = document.getElementById('custom-threshold');
  nearbyButton.style.display = 'none';
  customThresholdInput.style.display = 'none';

  // Show the "Show All" button
  var showAllButton = document.getElementById('show-all-button');
  showAllButton.style.display = 'inline-block'; // Use "inline-block" to make it visible

  // Add a click event listener to the "Show All" button
  showAllButton.addEventListener('click', function () {
    // Show the input field after clicking "Show All"
    customThresholdInput.style.display = 'inline-block'; // Use "inline-block" to make it visible

    // Bring back the nearby button
    nearbyButton.style.display = 'inline-block'; // Use "inline-block" to make it visible

    // Hide the "Show All" button
    showAllButton.style.display = 'none';
  });
}

/// Add a click event listener to the "Nearby" button
document.getElementById('nearby-button').addEventListener('click', showNearbyMarkers);

// Add a click event listener to the "Show All" button
document.getElementById('show-all-button').addEventListener('click', function () {
  // Handle UI changes in the handleUINearbyButtonClick function
  handleUINearbyButtonClick();

  // Call the function to show all markers
  showAllPlaces();
});

var searchInput = document.querySelector('.search-bar');

searchInput.addEventListener('input', function () {
  var userInput = searchInput.value.toLowerCase();

  filterPerakMarkers(userInput);
});

function filterPerakMarkers(userInput) {
  // Clear the previous suggestions
  var resultBox = document.querySelector('.result-box');
  var suggestions = document.createElement('ul');
  suggestions.innerHTML = '';

  // Check if the search input is empty
  if (userInput.trim() === '') {
    // Hide the result box if the input is empty
    resultBox.style.display = 'none';
    isSuggestionsOpen = false;
  } else {
    // Show the result box if there is user input
    resultBox.style.display = 'block';
    isSuggestionsOpen = true;

    // Filter the PerakMarkers based on user input
    var filteredMarkers = perakMarkers.filter(function (marker) {
      return (
        marker.name.toLowerCase().includes(userInput) ||
        marker.city.toLowerCase().includes(userInput) // Check if user input matches either title or city
      );
    });

    // Display the suggestions in the result box
    filteredMarkers.forEach(function (marker) {
      var suggestionItem = document.createElement('li');
      suggestionItem.textContent = marker.name;
      suggestions.appendChild(suggestionItem);

      // Add a click event listener to the suggestion item to populate the search input
      suggestionItem.addEventListener('click', function () {
        searchInput.value = marker.name;
        suggestions.innerHTML = ''; // Clear the suggestions

        // Hide the result box after a suggestion is clicked
        resultBox.style.display = 'none';
        isSuggestionsOpen = false;
      });
    });
  }

  // Clear the result box if there are no matching suggestions
  if (suggestions.children.length === 0) {
    resultBox.style.display = 'none';
    isSuggestionsOpen = false;
  } else {
    // Append the suggestions to the result box
    resultBox.innerHTML = '';
    resultBox.appendChild(suggestions);
  }
}


document.addEventListener('click', function (event) {
  if (!searchInput.contains(event.target)) {
    // Clicked outside the search bar, close the suggestions
    var resultBox = document.querySelector('.result-box');
    resultBox.style.display = 'none';
    isSuggestionsOpen = false;
  }
});

searchInput.addEventListener('click', function () {
  // Clicked on the search bar, reappear the suggestions
  if (isSuggestionsOpen) {
    var resultBox = document.querySelector('.result-box');
    resultBox.style.display = 'block';
  }
});




function searchAndOpenMarker(userInput) {
  var filteredMarker = perakMarkers.find(function (marker) {
    return (
      marker.name.toLowerCase() === userInput.toLowerCase() ||
      marker.city.toLowerCase() === userInput.toLowerCase()
    );
  });

  if (filteredMarker) {
    openInfoWindowAndCenterMap(filteredMarker);
  } else {
    alert("Marker not found."); // You can handle what to do when the marker is not found
  }
}

// Add a click event listener to the "Search" button
var searchButton = document.getElementById('search-button');

searchButton.addEventListener('click', function () {
  var userInput = searchInput.value.toLowerCase();
  searchAndDisplayResults(userInput);
});

// Function to search for markers and display matching results
function searchAndDisplayResults(userInput) {
  // Clear the existing map and bottom bar
  var cardContainer = document.getElementById('bottom-bar');
  cardContainer.innerHTML = '';

  // Close the previous info window if it's open
  if (currentInfoWindow) {
    currentInfoWindow.close();
  }

  // Add the user's location marker
  var userIcon = {
    url: './lib/user.png',
    scaledSize: new google.maps.Size(40, 40),
  };
  var userMarker = new google.maps.Marker({
    position: userLatLng,
    map: map,
    title: 'Your Location',
    icon: userIcon,
  });

  // Initialize variables for centering the map on the searched marker
  var centerLatLng = null;

  // Initialize a counter for matching markers
  var matchingMarkerCount = 0;
  var matchingMarkerData = null;

  // Iterate through the Perak markers and check for partial title or city matches
  for (var i = 0; i < perakMarkers.length; i++) {
    var markerData = perakMarkers[i];

    if (
      markerData.name.toLowerCase().includes(userInput) ||
      markerData.city.toLowerCase().includes(userInput)
    ) {
      // Increment the counter
      matchingMarkerCount++;

      // Save the matching marker data
      matchingMarkerData = markerData;

      // Add marker to the map
      addMarkerWithInfoWindow(map, markerData);
      // Add card to the bottom bar
      addCardToBottomBar(cardContainer, markerData);

      // Set the centerLatLng to the position of the matching marker
      centerLatLng = new google.maps.LatLng(markerData.lat, markerData.lng);
    }
  }

  // If only one matching marker was found, center the map on its position and open its info window
  if (matchingMarkerCount === 1) {
    openInfoWindowAndCenterMap(matchingMarkerData);
  } else {
    // If multiple or no matching markers were found, set the map center to user's location
    map.setCenter(userLatLng);
  }

  // Update the currently open info window if any
  if (currentInfoWindow) {
    openInfoWindowAndCenterMap(currentInfoWindow.markerData);
  }
}




// Function to show all markers
function showAllPlaces() {
  // Clear the existing map
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  // Create a user marker
  var userIcon = {
    url: './lib/user.png',
    scaledSize: new google.maps.Size(40, 40),
  };
  var userMarker = new google.maps.Marker({
    position: userLatLng,
    map: map,
    title: 'Your Location',
    icon: userIcon,
  });

  // Clear the existing cards in the bottom bar
  var cardContainer = document.getElementById('bottom-bar');
  cardContainer.innerHTML = '';

  // Loop through all the custom markers and add them to the map
  for (var i = 0; i < perakMarkers.length; i++) {
    addMarkerWithInfoWindow(map, perakMarkers[i]);
    addCardToBottomBar(cardContainer, perakMarkers[i]);
  }

  // User marker should be visible after all markers are added
  userMarker.setMap(map);
}

var searchInput = document.querySelector('.search-bar');

searchInput.addEventListener('input', function () {
  var userInput = searchInput.value.toLowerCase();

  filterPerakMarkers(userInput);
});


