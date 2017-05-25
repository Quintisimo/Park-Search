<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  include 'Search.php';
  pageHead();
?>

<body>
  <?php
  session_start();

  if (isset($_SESSION)) {
    $menu = array('Home', 'Logout');
  } else {
    $menu = array('Home', 'Register or Login');
  }
    pageHeader('Parks near you', $menu);
  ?>

  <table id="results_table">
    <th>Park Name</th>
    <th>Street Name</th>
    <?php
      if (isset($_GET['submit'])) {

        if ($_GET['search_options'] == 'name') {
          nameSearch();
        }

        if ($_GET['search_options'] == 'suburb') {
          suburbSearch();
        }

        if ($_GET['search_options'] == 'rating') {

        }

        if ($_GET['search_options'] == 'location') {

        }
      }

    ?>
  </table>

  <!--<footer>Click on a park to read more and write a review</footer>-->
</body>

</html>
