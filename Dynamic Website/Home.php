<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
?>

<body onload="searchType()">
  <?php
    $menu = array('Register or Login');
    pageHeader('Find a Park Near You', $menu);
  ?>

  <div id="logo_and_search">
    <img src="Images/Park.png" alt="Park Image">

    <form>
      <input type="text" name="search" id="search" placeholder="" required>

      <select name="search_options" onchange="searchType()" id="search_options">
      <option value="suburb" name="suburb">Suburb</option>
      <option value="name" name="name">Name</option>
      <option value="rating" name="rating">Rating</option>
      <option value="location" name="location">Location</option>
      </select>

      <input type="submit" class="button" id="search_button">

      <input type="button" onclick="getLocation()" value="Get Location" class="button" id="location_button">
    </form>
  </div>

  <p id="footer">Get out of the house and enjoy life. Sweat is just fat crying.</p>
</body>

</html>
