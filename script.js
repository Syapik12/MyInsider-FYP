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
{
  lat: 4.501110776167158, 
  lng: 100.78025342733193,
  name: 'Beruas Museum',
  placeID: "11",
  description: 'Collects artifacts from the lost kingdom of Ganga Negara and Beruas.',
  images: ['./lib/beruas1.jpg', './lib/beruas2.jpg', './lib/beruas3.jpg'],
  detailPageUrl: 'beruas.php',
  city: 'Beruas'
},
{
  lat: 4.604607013997345, 
  lng: 101.07798418303425,
  name: 'Darul Ridzuan Museum',
  placeID: "12",
  description: 'Became a museum in 1992 after serving as the administrative center for the Department of Works.',
  images: ['./lib/darul1.jpg', './lib/darul2.jpg', './lib/darul3.jpg'],
  detailPageUrl: 'darul.php',
  city: 'Ipoh'
},
{
  lat: 4.597555863211378, 
  lng: 101.11978743548211,
  name: 'Geological Museum',
  placeID: "13",
  description: 'Founded in 1957, underwent renovations and expansions under the Ninth Malaysia Plan for increased exhibition space and collections.',
  images: ['./lib/geological1.jpg', './lib/geological2.jpg', './lib/geological3.jpg'],
  detailPageUrl: 'geological.php',
  city: 'Ipoh'
},
{
  lat: 4.602315894830714, 
  lng: 101.08044796493414,
  name: 'Palong Tin Museum',
  placeID: "14",
  description: 'A collaborative tourism project by Kinta Riverfront Hotel, Ipoh City Council, and Perak Water and Drainage Department, enhancing the Kinta River side landscape.',
  images: ['./lib/Palong1.jpg', './lib/Palong2.jpg', './lib/Palong3.jpg'],
  detailPageUrl: 'Palong.php',
  city: 'Ipoh'
},
{
  lat: 4.760231631759715, 
  lng: 100.95573296493383,
  name: 'Istana Kenangan',
  placeID: "15",
  description: 'Built in 1926 for Sultan Iskandar Shah, now Perak Royal Museum, served as official residence (1931-1933) and later used for royal receptions.',
  images: ['./lib/kenangan1.jpg', './lib/kenangan2.jpg', './lib/kenangan3.jpg'],
  detailPageUrl: 'kenangan.php',
  city: 'Kuala Kangsar'
},
{
  lat: 4.1962335370561705, 
  lng: 100.70028091986305,
  name: 'Sitiawan Settlement Museum',
  placeID: "16",
  description: 'Built in 1935 as a residence for Pioneer Methodist Church pastors, the Sitiawan Settlement Museum in Malaysia was converted into a museum on September 7, 2003.',
  images: ['./lib/sitiawan1.jpg', './lib/sitiawan2.jpg', './lib/sitiawan3.jpg'],
  detailPageUrl: 'sitiawan.php',
  city: 'Sitiawan'
},
{
  lat: 4.459130399999544, 
  lng: 101.1928987354846,
  name: 'Gaharu Tea Valley',
  placeID: "17",
  description: 'Established in 2012, is an agro-tourism tea plantation in Gopeng, Perak, Malaysia.',
  images: ['./lib/Gaharu1.jpg', './lib/Gaharu2.jpg', './lib/Gaharu3.jpg'],
  detailPageUrl: 'Gaharu.php',
  city: 'Gopeng'
},
{
  lat: 4.862298258835708, 
  lng: 100.79300031104988,
  name: 'Bukit Larut (Maxwell Hill)',
  placeID: "18",
  description: 'Established in 1884, undergoes renovation post-public opposition to tourism development, with restricted access due to a landslide, hosting the annual North Face Malaysia Mountain Trail Festival.',
  images: ['./lib/larut1.jpg', './lib/larut2.jpg', './lib/larut3.jpg'],
  detailPageUrl: 'larut.php',
  city: 'Taiping'
},
{
  lat: 4.230169593723822, 
  lng: 100.54494878038328,
  name: 'Teluk Nipah Beach',
  placeID: "19",
  description: 'Pristine shores, vibrant activities, and exotic wildlife on Pangkor Island, with nearby islands offering coral-rich diving sites.',
  images: ['./lib/nipah1.jpg', './lib/nipah2.jpg', './lib/nipah3.jpg'],
  detailPageUrl: 'nipah.php',
  city: 'Pangkor Island'
},
{
  lat: 4.2093930396074954, 
  lng: 100.5579636517314,
  name: 'Pasir Bogak Beach',
  placeID: "20",
  description: 'Built in 1926 for Sultan Iskandar Shah, now Perak Royal Museum, served as official residence (1931-1933) and later used for royal receptions.',
  images: ['./lib/bogak1.jpg', './lib/bogak2.jpg', './lib/bogak3.jpg'],
  detailPageUrl: 'bogak.php',
  city: 'Pangkor Island'
},

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
        center: userLatLng, 
        zoom: 12,
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
        ],
      };

      // Create the map
      map = new google.maps.Map(document.getElementById('map'), mapOptions);

      var userIcon = {
        url: './lib/user.png',
        scaledSize: new google.maps.Size(40, 40),
      };

      // Add a marker for the user's location
      var userMarker = new google.maps.Marker({
        position: userLatLng,
        map: map,
        title: 'Your Location',
        icon: userIcon,
      });

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
    var distance = google.maps.geometry.spherical.computeDistanceBetween(
      new google.maps.LatLng(userLatLng.lat, userLatLng.lng),
      new google.maps.LatLng(markerData.lat, markerData.lng)
    );

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

var currentInfoWindow = null;

function openInfoWindowAndCenterMap(markerData) {
  if (currentInfoWindow) {
    currentInfoWindow.close();
  }

  var contentDiv = document.createElement('div');
  contentDiv.className = 'infoBox';

  var imgBxDiv = document.createElement('div');
  imgBxDiv.className = 'imgBx';

  var imageElement = document.createElement('img');
  imageElement.src = markerData.images[0];
  imageElement.alt = markerData.name;
  imgBxDiv.appendChild(imageElement);

  var contentContentDiv = document.createElement('div');
  contentContentDiv.className = 'content';
  contentContentDiv.innerHTML = `
    <h2>${markerData.name}</h2>
    <p>${markerData.description}</p>
    <a href="${markerData.detailPageUrl}?placeID=${markerData.placeID}" class="read-more-button">Read More</a>
  `;

  var leftArrow = document.createElement('button');
  leftArrow.className = 'arrow left-arrow';
  leftArrow.innerText = '<';

  var rightArrow = document.createElement('button');
  rightArrow.className = 'arrow right-arrow';
  rightArrow.innerText = '>';

  var currentIndex = 0;

  leftArrow.addEventListener('click', function () {
    currentIndex = (currentIndex - 1 + markerData.images.length) % markerData.images.length;
    imageElement.src = markerData.images[currentIndex];
  });

  rightArrow.addEventListener('click', function () {
    currentIndex = (currentIndex + 1) % markerData.images.length;
    imageElement.src = markerData.images[currentIndex];
  });

  contentDiv.appendChild(imgBxDiv);
  contentDiv.appendChild(leftArrow);
  contentDiv.appendChild(rightArrow);
  contentDiv.appendChild(contentContentDiv);

  currentInfoWindow = new google.maps.InfoWindow({
    content: contentDiv
  });

  currentInfoWindow.open(map, markerData.marker);

  var markerPosition = markerData.marker.getPosition();
  var targetZoom = 12;

  map.panTo(markerPosition);
  map.setZoom(targetZoom);
}


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

    markerData.marker = marker;
    markerData.placeID = markerData.placeID;

    marker.addListener('click', function () {
      openInfoWindowAndCenterMap(markerData);
    });
  } else {
    console.error('Marker data does not contain images or is empty.');
  }
}

function showNearbyMarkers() {
  if (navigator.geolocation) {
    var customThresholdInput = document.getElementById('custom-threshold');
    var customThresholdValue = parseFloat(customThresholdInput.value); // Parse as float for kilometers

    if (isNaN(customThresholdValue) || customThresholdValue <= 0) {
      alert("Please enter a valid positive numeric threshold value in kilometers.");
      return;
    }

    var threshold = customThresholdValue * 1000;

    navigator.geolocation.getCurrentPosition(function (position) {
      var userLatLng = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      map = new google.maps.Map(document.getElementById('map'), mapOptions);

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

      var cardContainer = document.getElementById('bottom-bar');
      cardContainer.innerHTML = '';

      for (var i = 0; i < perakMarkers.length; i++) {
        var markerData = perakMarkers[i]; // Retrieve the marker data
        var markerLatLng = {
          lat: markerData.lat,
          lng: markerData.lng
        };

        var distance = google.maps.geometry.spherical.computeDistanceBetween(
          new google.maps.LatLng(userLatLng.lat, userLatLng.lng),
          new google.maps.LatLng(markerLatLng.lat, markerLatLng.lng)
        );

        if (distance <= threshold) {
          addMarkerWithInfoWindow(map, markerData);
          addCardToBottomBar(cardContainer, markerData, distance);
        }
      }
      userMarker.setMap(map);

      handleUINearbyButtonClick();
    });
  }
}

function handleUINearbyButtonClick() {
  var nearbyButton = document.getElementById('nearby-button');
  var customThresholdInput = document.getElementById('custom-threshold');
  nearbyButton.style.display = 'none';
  customThresholdInput.style.display = 'none';

  var showAllButton = document.getElementById('show-all-button');
  showAllButton.style.display = 'inline-block'; 

  showAllButton.addEventListener('click', function () {
    customThresholdInput.style.display = 'inline-block'; 

    nearbyButton.style.display = 'inline-block'; 

    showAllButton.style.display = 'none';
  });
}

document.getElementById('nearby-button').addEventListener('click', showNearbyMarkers);

document.getElementById('show-all-button').addEventListener('click', function () {

  handleUINearbyButtonClick();


  showAllPlaces();
});

var searchInput = document.querySelector('.search-bar');

searchInput.addEventListener('input', function () {
  var userInput = searchInput.value.toLowerCase();

  filterPerakMarkers(userInput);
});

function filterPerakMarkers(userInput) {
  var resultBox = document.querySelector('.result-box');
  var suggestions = document.createElement('ul');
  suggestions.innerHTML = '';

  if (userInput.trim() === '') {
    resultBox.style.display = 'none';
    isSuggestionsOpen = false;
  } else {
    resultBox.style.display = 'block';
    isSuggestionsOpen = true;

    var filteredMarkers = perakMarkers.filter(function (marker) {
      return (
        marker.name.toLowerCase().includes(userInput) ||
        marker.city.toLowerCase().includes(userInput) // Check if user input matches either title or city
      );
    });

    filteredMarkers.forEach(function (marker) {
      var suggestionItem = document.createElement('li');
      suggestionItem.textContent = marker.name;
      suggestions.appendChild(suggestionItem);

      suggestionItem.addEventListener('click', function () {
        searchInput.value = marker.name;
        suggestions.innerHTML = ''; // Clear the suggestions

        resultBox.style.display = 'none';
        isSuggestionsOpen = false;
      });
    });
  }

  if (suggestions.children.length === 0) {
    resultBox.style.display = 'none';
    isSuggestionsOpen = false;
  } else {
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
    alert("Marker not found."); 
  }
}

var searchButton = document.getElementById('search-button');

searchButton.addEventListener('click', function () {
  var userInput = searchInput.value.toLowerCase();
  searchAndDisplayResults(userInput);
});

function searchAndDisplayResults(userInput) {
  var cardContainer = document.getElementById('bottom-bar');
  cardContainer.innerHTML = '';

  if (currentInfoWindow) {
    currentInfoWindow.close();
  }

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

  var centerLatLng = null;

  var matchingMarkerCount = 0;
  var matchingMarkerData = null;

  for (var i = 0; i < perakMarkers.length; i++) {
    var markerData = perakMarkers[i];

    if (
      markerData.name.toLowerCase().includes(userInput) ||
      markerData.city.toLowerCase().includes(userInput)
    ) {
      matchingMarkerCount++;

      matchingMarkerData = markerData;

      addMarkerWithInfoWindow(map, markerData);
      addCardToBottomBar(cardContainer, markerData);

      centerLatLng = new google.maps.LatLng(markerData.lat, markerData.lng);
    }
  }

  if (matchingMarkerCount === 1) {
    openInfoWindowAndCenterMap(matchingMarkerData);
  } else {
    map.setCenter(userLatLng);
  }

  if (currentInfoWindow) {
    openInfoWindowAndCenterMap(currentInfoWindow.markerData);
  }
}




function showAllPlaces() {
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

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

  var cardContainer = document.getElementById('bottom-bar');
  cardContainer.innerHTML = '';

  for (var i = 0; i < perakMarkers.length; i++) {
    addMarkerWithInfoWindow(map, perakMarkers[i]);
    addCardToBottomBar(cardContainer, perakMarkers[i]);
  }

  userMarker.setMap(map);
}

var searchInput = document.querySelector('.search-bar');

searchInput.addEventListener('input', function () {
  var userInput = searchInput.value.toLowerCase();

  filterPerakMarkers(userInput);
});


