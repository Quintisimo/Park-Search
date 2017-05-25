<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  pageHead();
?>

<body onload="searchType()">
  <?php
    session_start();

    if (isset($_SESSION)) {
      $menu = array('Logout');
    } else {
      $menu = array('Register or Login');
    }
    pageHeader('Find a Park Near You', $menu);
  ?>

  <div id="logo_and_search">
    <img src="Images/Park.png" alt="Park Image">

    <form action="Results.php" method="get">
      <input type="text" id="search" placeholder="">

      <?php
        $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
        $data = $pdo->query('SELECT MIN(suburb) AS suburb FROM parks GROUP BY suburb');
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

      <input type="submit" class="button" name="submit" id="search_button">

      <input type="button" onclick="getLocation()" value="Get Location" class="button" id="location_button">
    </form>
  </div>

  <footer>Get out of the house and enjoy life</footer>
</body>

</html>
