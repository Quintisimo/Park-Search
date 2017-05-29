function searchType() {
  var search_options = document.getElementById("search_options"),
    search = document.getElementById("search"),
    rating = document.getElementById('rating_options');
    suburb = document.getElementById('suburb_options');
    location_button = document.getElementById("location_button");

  if (search_options.value == "name") {
    search.style.display = "inline";
    search.name = "name_search";
    search.required = true;
    rating.style.display = "none";
    suburb.style.display = "none";
    search.placeholder = "Enter the name of the park..";
    location_button.style.visibility = "hidden";
  }

  if (search_options.value == "suburb") {
    search.style.display = "none";
    search.required = false;
    rating.style.display = "none";
    suburb.style.display = "inline";
    location_button.style.visibility = "hidden";
  }

  if (search_options.value == "rating") {
    search.style.display = "none";
    rating.style.display = "inline";
    search.required = false;
    suburb.style.display = "none";
    location_button.style.visibility = "hidden";
  }

  if (search_options.value == "location") {
    search.style.display = "inline";
    search.name = "location_search";
    search.required = true;
    rating.style.display = "none";
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

function individualMap(latitude, longitude) {
  var location = {
    lat: latitude,
    lng: longitude
  };

  var map = new google.maps.Map(document.getElementById("individual_map"), {
    zoom: 16,
    center: location
  });

  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
}

function searchMap(location_array) {
  var map = new google.maps.Map(document.getElementById("search_map"), {
    zoom: 13,
    center: {lat: -27.470125, lng: 153.080072}
  });

  if (location_array.length < 100) {
    var bounds = new google.maps.LatLngBounds();
  }

  for (i = 0; i < location_array.length; i++) {
    var remove_quote_name = location_array[i][1].replace("'", "\\'");
    var remove_quote_street = location_array[i][2].replace("'", "\\'");

    var infowindow = new google.maps.InfoWindow({
      content: '\'' + remove_quote_name + '<br>' + remove_quote_street + '<br><a href="Park.php?id='+ location_array[i][0] + '">See review</a>'
    });

    var marker = new google.maps.Marker({
      position: {lat: location_array[i][3], lng:location_array[i][4]},
      map: map,
      infowindow: infowindow
    });

    google.maps.event.addListener(marker, 'click', function() {
      this.infowindow.open(map, this);
    });

    if (location_array.length < 100) {
      bounds.extend(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));
    }
  }

  if (location_array.length < 100) {
    map.fitBounds(bounds);
    map.panToBounds(bounds);
  }
}

function closeDialog() {
  var dialog = document.getElementById('messagebox_register');
  dialog.close();
}

function redirectDialog() {
  window.location.href = "home.php";
}

function goBack() {
  history.go(-1);
}

function moveFooter() {
  var footer = document.getElementsByTagName('FOOTER')[0],
  vertical_scroll = document.body.scrollHeight > window.innerHeight;

  if (vertical_scroll) {
    footer.style.position = "relative";
    footer.style.margin = "30px 0 0 0";
  }
}
