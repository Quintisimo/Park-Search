<?php
  include 'PDO.php';

  //Gets search string from form, searches through the databse for matches and generates a table of the result found
  function nameSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, suburb, latitude, longitude FROM items WHERE name LIKE :name');
    $result->bindValue(':name', "%$_GET[name_search]%");
    $result->execute();
    $marker_location = array();

    if ($result->rowCount() > 0) {
      if (empty($_GET['name_search'])) {
        $marker_location = allResults();
      } else {
        echo "<h3>Search results for: <span>$_GET[name_search]</span></h3>";
        echo '<div id="search_map"></div>';
        echo '<table id="results_table">';
        echo '<th>Park Name</th>';
        echo '<th>Street Name</th>';
        echo '<th>Suburb</th>';

        foreach ($result as $row) {
          $name = strtolower($row['name']);
          $street = strtolower($row['street']);
          $suburb = strtolower($row['suburb']);
          $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
          echo '<tr>';
          echo "<td>$name<br>";
          echo "<a href=\"Park.php?id=$row[id]\">See reviews</a></td>";
          echo "<td>$street</td>";
          echo "<td>$suburb</td>";
          echo '</tr>';
        }
        echo '</table>';
      }
    } else {
      echo "<h3>No results found for: <span>$_GET[name_search]</span></h3>";
    }
    return $marker_location;
  }

  //Generates a results table showing all the parks found in the selected suburb
  function suburbSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, latitude, longitude FROM items WHERE suburb = :suburb');
    $result->bindValue(':suburb', $_GET['suburb_search']);
    $result->execute();
    $marker_location = array();
    echo "<h3>Search results for: <span>$_GET[suburb_search]</span></h3>";
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
      echo "<a href=\"Park.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo '</tr>';
    }
    echo '</table>';
    return $marker_location;
  }

  //Generates a results table showing all the parks found with the selected rating
  function ratingSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, suburb, latitude, longitude FROM items WHERE averagerating = :averagerating');
    $result->bindValue(':averagerating', $_GET['rating_search']);
    $result->execute();
    $marker_location = array();

    if ($result->rowCount() > 0) {
      if (empty($_GET['rating_search'])) {
        $marker_location = allResults();
      } else {
        echo "<h3>Search results for $_GET[rating_search] star parks</h3>";
        echo '<div id="search_map"></div>';
        echo '<table id="results_table">';
        echo '<th>Park Name</th>';
        echo '<th>Street Name</th>';
        echo '<th>Suburb</th>';

        foreach ($result as $row) {
          $name = strtolower($row['name']);
          $street = strtolower($row['street']);
          $suburb = strtolower($row['suburb']);
          $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
          echo '<tr>';
          echo "<td>$name<br>";
          echo "<a href=\"Park.php?id=$row[id]\">See reviews</a></td>";
          echo "<td>$street</td>";
          echo "<td>$suburb</td>";
          echo '</tr>';
        }
        echo '</table>';
      }
    } else {
      echo "<h3>No results found for $_GET[rating_search] star parks</h3>";
    }
    return $marker_location;
  }

  //Generates a results table showing all the parks found around a 1km radius of the specified location
  function locationSearch() {
    $location = $_GET['location_search'];

    if (empty($_GET['location_search'])) {
      $marker_location = allResults();
    } else {
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

      $result = $GLOBALS['pdo']->prepare('SELECT id, name, street, suburb, latitude, longitude FROM items WHERE latitude BETWEEN :minlat AND :maxlat AND longitude BETWEEN :minlong AND :maxlong ORDER BY (POW((latitude - :lat),2) + POW((longitude - :long),2)),2');
      $result->bindValue(':minlat', $min_lat);
      $result->bindValue(':maxlat', $max_lat);
      $result->bindValue(':minlong', $min_long);
      $result->bindValue(':maxlong', $max_long);
      $result->bindValue(':lat', $lat);
      $result->bindValue(':long', $long);
      $result->execute();
      $marker_location = array();

      if ($result->rowCount() > 0) {
        echo "<h3>Parks within a $search_rad km radius</h3>";
        echo '<div id="search_map"></div>';
        echo '<table id="results_table">';
        echo '<th>Park Name</th>';
        echo '<th>Street Name</th>';
        echo '<th>Suburb</th>';

        foreach ($result as $row) {
          $name = strtolower($row['name']);
          $street = strtolower($row['street']);
          $suburb = strtolower($row['suburb']);
          $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
          echo '<tr>';
          echo "<td>$name<br>";
          echo "<a href=\"Park.php?id=$row[id]\">See reviews</a></td>";
          echo "<td>$street</td>";
          echo "<td>$suburb</td>";
          echo '</tr>';
        }
        echo '</table>';
      } else {
        echo '<h3>No parks found near you</h3>';
      }
    }
    return $marker_location;
  }

  //If javascript is disables, generates a results table with all the parks present in the database ordered by id
  function allResults() {
    $result = $GLOBALS['pdo']->query('SELECT id, name, street, suburb, latitude, longitude FROM items');
    echo '<h3>Showing results for every park in Brisbane</h3>';
    echo '<div id="search_map"></div>';
    echo '<table id="results_table">';
    echo '<th>Park Name</th>';
    echo '<th>Street Name</th>';
    echo '<th>Suburb</th>';
    $marker_location = array();

    foreach ($result as $row) {
      $name = strtolower($row['name']);
      $street = strtolower($row['street']);
      $suburb = strtolower($row['suburb']);
      $marker_location[] = array($row['id'], $name, $street, $row['latitude'], $row['longitude']);
      echo '<tr>';
      echo "<td>$name<br>";
      echo "<a href=\"Park.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo "<td>$suburb</td>";
      echo '</tr>';
    }
    echo '</table>';
    return $marker_location;
  }
?>
