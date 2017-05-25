var latitude, longitude;

function searchType() {
  var search_options = document.getElementById("search_options"),
    search = document.getElementById("search"),
    suburb = document.getElementById('suburb_options');
    location_button = document.getElementById("location_button");

  if (search_options.value == "name") {
    search.style.display = "inline";
    search.name = "name_search";
    search.required = true;
    suburb.style.display = "none";
    search.placeholder = "Enter the name of the park..";
    location_button.style.visibility = "hidden";
  }

  if (search_options.value == "suburb") {
    search.style.display = "none";
    search.required = false;
    suburb.style.display = "inline";
    location_button.style.visibility = "hidden";
  }

  if (search_options.value == "rating") {
    search.style.display = "inline";
    search.name = "rating_search";
    search.required = true;
    suburb.style.display = "none";
    search.type = "number";
    search.placeholder = "Enter a rating between 1 and 5..";
    location_button.style.visibility = "hidden";
  }

  if (search_options.value == "location") {
    search.style.display = "inline";
    search.name = "location_search";
    search.required = true;
    suburb.style.display = "none";
    search.placeholder = "Click the button below to determine your location..";
    location_button.style.visibility = "visible";
  }
}


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    window.alert("Determining location is not supported by this browser.");
  }
}

function showPosition(position) {
  latitude = position.coords.latitude.toFixed(8);
  longitude = position.coords.longitude.toFixed(8);
  search.value = latitude + "," + longitude;
}

function showError(error) {
  switch (error.code) {
    case error.PERMISSION_DENIED:
      window.alert("User denied the request for location.");
      break;
    case error.POSITION_UNAVALIABLE:
      window.alert("Location cannot be determined.");
      break;
    case error.TIMEOUT:
      window.alert("The request to get location has timed out");
      break;
    case error.UNKNOWN_ERROR:
      window.alert("An unknown error occured.");
  }
}

function initMap(latitude, longitude) {
  var location = {
    lat: latitude,
    lng: longitude
  };
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: location
  });
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
}

function closeDialog() {
  var dialog = document.getElementById('messagebox_register');
    dialog.close();
}

function redirectDialog() {
  window.location.href = "home.php";
}
