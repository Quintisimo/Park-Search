<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  pageHead();
?>

<body>
  <?php
    $menu = array('Home', 'Register or Login');
    pageHeader('Parks near you', $menu);
  ?>

  <div id="results_table">
  </div>

  <footer>Click on a park to read more and write a review</footer>
</body>

</html>
