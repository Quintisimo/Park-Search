<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'Template.php';
  include 'Search.php';
  // Generates page header with Google Maps script
  pageHead('map');
?>

<body onload="moveFooter();">
  <?php
    if (!empty($_SESSION['park_search'])) {
      $menu = array('Home', 'Logout');
    } else {
      $menu = array('Home', 'Register or Login');
    }
    //Generates page heading
    pageHeader('Parks near you', $menu);

    if (isset($_GET['submit'])) {

      if ($_GET['search_options'] == 'name') {
        //Perform search using the name of the park and get map marker locations in an array
        $location_array = nameSearch();
      }

      if ($_GET['search_options'] == 'suburb') {
        //Perform search using the suburb of parks and get map marker locations in an array
        $location_array = suburbSearch();
      }

      if ($_GET['search_options'] == 'rating') {
        //Perform search using the rating of parks and get map marker locations in an array
        $location_array = ratingSearch();
      }

      if ($_GET['search_options'] == 'location') {
        //Perform search using the users location showing parks in a 1km radius and get map marker locations in an array
        $location_array = locationSearch();
      }
    }
  ?>

  <script type="text/javascript">
    //Converting PHP location array into a JSON
    var location_array = <?php echo json_encode($location_array, JSON_NUMERIC_CHECK); ?>;
    //Calls javascript function to generate the map
    searchMap(location_array);
  </script>

  <footer>Click on a park to read more and write a review</footer>
</body>

</html>
