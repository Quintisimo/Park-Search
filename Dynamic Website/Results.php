<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'Template.php';
  include 'Search.php';
  pageHead('map');
?>

<body onload="moveFooter();">
  <?php
    if (!empty($_SESSION['park_search'])) {
      $menu = array('Home', 'Logout');
    } else {
      $menu = array('Home', 'Register or Login');
    }
      pageHeader('Parks near you', $menu);

    if (isset($_GET['submit'])) {

      if ($_GET['search_options'] == 'name') {
        $location_array = nameSearch();
      }

      if ($_GET['search_options'] == 'suburb') {
        $location_array = suburbSearch();
      }

      if ($_GET['search_options'] == 'rating') {
        $location_array = ratingSearch();
      }

      if ($_GET['search_options'] == 'location') {
        $location_array = locationSearch();
      }
    }
  ?>

  <script type="text/javascript">
    var location_array = <?php echo json_encode($location_array, JSON_NUMERIC_CHECK); ?>;
    console.log(location_array);
    searchMap(location_array);
  </script>
  <footer>Click on a park to read more and write a review</footer>
</body>

</html>
