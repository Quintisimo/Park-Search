<head>
  <title>Park Search</title>
  <link href="CSS/Style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="JavaScript/Script.js"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8e4vYN5deeGZGekRU9tD-KWYxACyXKRw&callback=initMap"></script>
</head>

<?php function menu($menu_item) {
  echo "<a href=\"$menu_item.php\">$menu_item</a>";
} ?>
