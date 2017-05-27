<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');

  function nameSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, latitude, longitude FROM parks WHERE name LIKE :name');
    $result->bindValue(':name', "%$_GET[name_search]%");
    $result->execute();
    $marker_location = array();

    if ($result->rowCount() > 0) {
      echo "<h3>Search results for: $_GET[name_search]</h3>";
      echo '<div id="search_map"></div>';
      echo '<table id="results_table">';
      echo '<th>Park Name</th>';
      echo '<th>Street Name</th>';

      foreach ($result as $row) {
        $name = strtolower($row['name']);
        $street = strtolower($row['street']);
        $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
        echo '<tr>';
        echo "<td>$name<br>";
        echo "<a href=\"Review.php?id=$row[id]\">See reviews</a></td>";
        echo "<td>$street</td>";
        echo '</tr>';
      }
      echo '</table>';
      searchMap($marker_location);

    } else {
      echo "<h3>No results found for: $_GET[name_search]</h3>";
    }
  }

  function suburbSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, latitude, longitude FROM parks WHERE suburb = :suburb');
    $result->bindValue(':suburb', $_GET['suburb_search']);
    $result->execute();
    $marker_location = array();
    echo "<h3>Search results for: $_GET[suburb_search]</h3>";
    echo '<div id="search_map"></div>';
    echo '<table id="results_table">';
    echo '<th>Park Name</th>';
    echo '<th>Street Name</th>';

    foreach ($result as $row) {
      $name = strtolower($row['name']);
      $street = strtolower($row['street']);
      $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
      echo '<tr>';
      echo "<td>$name<br>";
      echo "<a href=\"Review.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo '</tr>';
    }
    echo '</table>';
    searchMap($marker_location);
  }

  function locationSearch() {
    $location = $_GET['location_search'];
    $lat = substr($location, 0, 12);
    $long = substr($location, -12);
    $earth_rad = 6371;
		$search_rad = 1;

		$max_lat = $lat + rad2deg($search_rad/$earth_rad);
		$min_lat = $lat - rad2deg($search_rad/$earth_rad);
		$max_long = $long + rad2deg($search_rad/$earth_rad/cos(deg2rad($lat)));
		$min_long = $long - rad2deg($search_rad/$earth_rad/cos(deg2rad($lat)));

		$max_lat = number_format((float)$max_lat, 8, '.', '');
		$min_lat = number_format((float)$min_lat, 8, '.', '');
		$max_long = number_format((float)$max_long, 8, '.', '');
		$min_long = number_format((float)$min_long, 8, '.', '');

    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, latitude, longitude FROM parks WHERE latitude BETWEEN :minlat AND :maxlat AND longitude BETWEEN :minlong AND :maxlong ORDER BY (POW((latitude - :lat),2) + POW((longitude - :long),2)),2');
    $result->bindValue(':minlat', $min_lat);
    $result->bindValue(':maxlat', $max_lat);
    $result->bindValue(':minlong', $min_long);
    $result->bindValue(':maxlong', $max_long);
    $result->bindValue(':lat', $lat);
    $result->bindValue(':long', $long);
    $result->execute();
    $marker_location = array();
    echo "<h3>Parks within a $search_rad km radius</h3>";
    echo '<div id="search_map"></div>';
    echo '<table id="results_table">';
    echo '<th>Park Name</th>';
    echo '<th>Street Name</th>';

    foreach ($result as $row) {
      $name = strtolower($row['name']);
      $street = strtolower($row['street']);
      $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
      echo '<tr>';
      echo "<td>$name<br>";
      echo "<a href=\"Review.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo '</tr>';
    }
    echo '</table>';
    searchMap($marker_location);
  }

  function searchMap($array) {
    echo '<script type="text/javascript">';
    echo 'function initMap() {';
    echo 'var map = new google.maps.Map(document.getElementById("search_map"), {';
    echo '});';
    echo 'var bounds  = new google.maps.LatLngBounds();';

    foreach ($array as $array_item) {
      echo "var infowindow = new google.maps.InfoWindow({";
      echo "content: '$array_item[1]<br>$array_item[2]<br><a href=\"Review.php?id=$array_item[0]\">See reviews</a></td>'";
      echo ' });';
      echo "var marker = new google.maps.Marker({";
      echo "position: {lat: $array_item[3], lng: $array_item[4]},";
      echo 'map: map,';
      echo 'infowindow: infowindow';
      echo '});';
      echo "google.maps.event.addListener(marker, 'click', function() {";
      echo "this.infowindow.open(map, this);";
      echo '});';
      echo 'bounds.extend(new google.maps.LatLng(marker.position.lat(), marker.position.lng()));';
    }
    echo 'map.fitBounds(bounds);';
    echo 'map.panToBounds(bounds);';
    echo '}';
    echo 'google.maps.event.addDomListener(window, "load", initMap);';
    echo '</script>';
  }
?>
