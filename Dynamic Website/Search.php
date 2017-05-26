<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');

  function nameSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street FROM parks WHERE name LIKE :name');
    $result->bindValue(':name', "%$_GET[name_search]%");
    $result->execute();

    if ($result->rowCount() > 0) {
      echo "<h3>Search results for: $_GET[name_search]</h3>";

      foreach ($result as $row) {
        $name = strtolower($row['name']);
        $street = strtolower($row['street']);
        echo '<tr>';
        echo "<td>$name<br>";
        echo "<a href=\"Review.php?id=$row[id]\">See reviews</a></td>";
        echo "<td>$street</td>";
        echo '</tr>';
      }

    } else {
      echo "<h3>No results found for: $_GET[name_search]</h3>";
    }
  }

  function suburbSearch() {
    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street FROM parks WHERE suburb = :suburb');
    $result->bindValue(':suburb', $_GET['suburb_search']);
    $result->execute();
    echo "<h3>Search results for: $_GET[suburb_search]</h3>";

    foreach ($result as $row) {
      $name = strtolower($row['name']);
      $street = strtolower($row['street']);
      echo '<tr>';
      echo "<td>$name<br>";
      echo "<a href=\"Review.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo '</tr>';
    }
  }

  function locationSearch() {
    $location = $_GET['location_search'];
    $lat = substr($location, 0, 12);
    $long = substr($location, -12);
    $earth_rad = 6371;
		$search_rad = 1;

		$maxLat = $lat + rad2deg($search_rad/$earth_rad);
		$minLat = $lat - rad2deg($search_rad/$earth_rad);
		$maxLong = $long + rad2deg($search_rad/$earth_rad/cos(deg2rad($lat)));
		$minLong = $long - rad2deg($search_rad/$earth_rad/cos(deg2rad($lat)));

		$maxLat = number_format((float)$maxLat, 8, '.', '');
		$minLat = number_format((float)$minLat, 8, '.', '');
		$maxLong = number_format((float)$maxLong, 8, '.', '');
		$minLong = number_format((float)$minLong, 8, '.', '');

    $result = $GLOBALS['pdo']->prepare('SELECT id, name, street FROM parks WHERE latitude BETWEEN :minlat AND :maxlat AND longitude BETWEEN :minlong AND :maxlong ORDER BY (POW((latitude - :lat),2) + POW((longitude - :long),2)),2');
    $result->bindValue(':minlat', $minLat);
    $result->bindValue(':maxlat', $maxLat);
    $result->bindValue(':minlong', $minLong);
    $result->bindValue(':maxlong', $maxLong);
    $result->bindValue(':lat', $lat);
    $result->bindValue(':long', $long);
    $result->execute();
    echo "<h3>Parks within a $search_rad km radius</h3>";

    foreach ($result as $row) {
      $name = strtolower($row['name']);
      $street = strtolower($row['street']);
      echo '<tr>';
      echo "<td>$name<br>";
      echo "<a href=\"Review.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo '</tr>';
    }
  }
?>
