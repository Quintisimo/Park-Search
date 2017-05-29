<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'Template.php';
  include 'PDO.php';
  // Generates page header
  pageHead();
?>

<body onload="searchType()">
  <?php
    // Checkes if a user is loggen in
    if (!empty($_SESSION['park_search'])) {
      $menu = array('Logout');
    } else {
      $menu = array('Register or Login');
    }
    // Generates page heading
    pageHeader('Find a Park Near You', $menu);
  ?>

  <div id="logo_and_search">
    <img src="Images/Park.png" alt="Park Image">

    <form action="Results.php" method="get">
      <input type="text" id="search" placeholder="Search for a park">

      <select name="rating_search" id="rating_options" class="dropdown">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
      </select>

      <?php
        //Generates suburb dropdown from database
        $data = $pdo->query('SELECT MIN(suburb) AS suburb FROM items GROUP BY suburb');
        echo '<select name="suburb_search" id="suburb_options" class="dropdown">';

        foreach ($data as $row) {
          $suburb = strtolower($row['suburb']);
          echo "<option value=\"$suburb\">$suburb</option>";
        }
        echo '</select>';
      ?>

      <select onchange="searchType()" name="search_options" id="search_options" class="dropdown">
      <option value="name" name="name">Name</option>
      <option value="suburb" name="suburb">Suburb</option>
      <option value="rating" name="rating">Rating</option>
      <option value="location" name="location">Location</option>
    </select>

      <input type="submit" class="button" value="Submit" name="submit" id="search_button">
      <input type="button" onclick="getLocation()" value="Get Location" class="button" id="location_button">
    </form>
  </div>

  <footer>Get out of the house and enjoy life</footer>
</body>

</html>
