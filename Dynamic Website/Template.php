<?php
  function pageHead($map = '') {
    echo '<head>';
    echo '<title>Park Search</title>';
    echo '<link href="CSS/Style.css" rel="stylesheet" type="text/css" />';
    echo '<script type="text/javascript" src="JavaScript/Script.js"></script>';

    if ($map == 'map') {
      echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8e4vYN5deeGZGekRU9tD-KWYxACyXKRw&callback=initMap"></script>';
    }
    echo '</head>';
  }

  function pageHeader($heading, $array) {
    echo '<header>';
    echo "<h1>$heading</h1>";
    echo '<nav>';

    foreach ($array as $array_item) {
      echo "<a href=\"$array_item.php\">$array_item</a>";

      if ($array_item == 'Logout') {
        $username = $_SESSION['park_search'];
        echo "<label>$username</label>";
      }
    }
    echo '</nav>';
    echo '</header>';
  }

?>
