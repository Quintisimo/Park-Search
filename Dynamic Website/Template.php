<head>
  <title>Park Search</title>
  <link href="CSS/Style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="JavaScript/Script.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8e4vYN5deeGZGekRU9tD-KWYxACyXKRw&callback=initMap"></script>
</head>

<?php function pageHeader($heading, $array) {
  echo "<div id=\"header\">";
  echo "<h1>$heading</h1>";
  
  foreach ($array as $array_item) {
    echo "<a href=\"$array_item.php\">$array_item</a>"; // Iterate throught array for multiple anchor's
  }
  echo "</div>";
} ?>
