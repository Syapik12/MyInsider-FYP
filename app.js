// Sample data
var perakMarkers = [
    {
      lat: 4.8617, 
      lng: 100.7453,
      name: 'Perak Museum',
      description: "A remarkable historical gem that transports you back in time to the late 19th century.",
      images: ['./lib/muziumperak1.jpg', './lib/muziumperak2.jpg', './lib/muziumperak3.jpg'],
      detailPageUrl: 'muziumperak.html'
    }
  ];
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
        var mapOptions = {
          center: userLatLng, // Center the map on the user's location
          zoom: 12, // Set the zoom level
        };

        // Create the map
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

  
  // Create markers and infowindows
  perakMarkers.forEach(function(markerData) {
    var marker = new google.maps.Marker({
      position: { lat: markerData.lat, lng: markerData.lng },
      map: map,
      title: markerData.name
    });
  
    var infoWindow = new google.maps.InfoWindow({
      content: createInfoWindowContent(markerData)
    });
  
    marker.addListener('click', function() {
      infoWindow.open(map, marker);
    });
  });
  
  // Function to create the custom InfoWindow content
  function createInfoWindowContent(markerData) {
    var currentIndex = 0;
  
    // Create the HTML structure for the InfoWindow
    var content = document.createElement('div');
    content.className = 'custom-infowindow';
  
    var imageContainer = document.createElement('div');
    imageContainer.className = 'image-container';
  
    var leftArrow = document.createElement('button');
    leftArrow.className = 'arrow left-arrow';
    leftArrow.innerText = '<';
  
    var rightArrow = document.createElement('button');
    rightArrow.className = 'arrow right-arrow';
    rightArrow.innerText = '>';
  
    var imageElement = document.createElement('img');
    imageElement.src = markerData.images[currentIndex];
  
    // Handle left arrow click
    leftArrow.addEventListener('click', function() {
      currentIndex = (currentIndex - 1 + markerData.images.length) % markerData.images.length;
      imageElement.src = markerData.images[currentIndex];
    });
  
    // Handle right arrow click
    rightArrow.addEventListener('click', function() {
      currentIndex = (currentIndex + 1) % markerData.images.length;
      imageElement.src = markerData.images[currentIndex];
    });
  
    imageContainer.appendChild(leftArrow);
    imageContainer.appendChild(imageElement);
    imageContainer.appendChild(rightArrow);
  
    content.appendChild(imageContainer);
  
    var title = document.createElement('h3');
    title.textContent = markerData.name;
  
    var description = document.createElement('p');
    description.textContent = markerData.description;
  
    content.appendChild(title);
    content.appendChild(description);
  
    return content;
  }
}};