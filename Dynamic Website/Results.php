<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'Template.php';
  include 'Search.php';
  pageHead('map');
?>

<body onload="moveFooter()">
  <?php
    if (!empty($_SESSION['park_search'])) {
      $menu = array('Home', 'Logout');
    } else {
      $menu = array('Home', 'Register or Login');
    }
      pageHeader('Parks near you', $menu);

    if (isset($_GET['submit'])) {

      if ($_GET['search_options'] == 'name') {
        nameSearch();
      }

      if ($_GET['search_options'] == 'suburb') {
        suburbSearch();
      }

      if ($_GET['search_options'] == 'rating') {
        ratingSearch();
      }

      if ($_GET['search_options'] == 'location') {
        locationSearch();
      }
    }
  ?>
  <footer>Click on a park to read more and write a review</footer>
</body>

</html>
