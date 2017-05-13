<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
?>

<body>
  <?php
    $menu = array('Home', 'Register or Login');
    pageHeader('Parks near you', $menu);
  ?>

  <div id="results_table">
  </div>

  <p id="footer">Click on a park to read more and write a review</p>
</body>

</html>
