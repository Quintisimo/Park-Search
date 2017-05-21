<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  pageHead();
?>

<body>
  <?php
    session_start();
    session_unset();
    session_destroy();

    $menu = array('Home', 'Register or Login');
    pageHeader('You have been logged out', $menu);
  ?>

  <h1 class="logout">Hope you have a great day</h1>
  <footer>See you again soon</footer>
</body>

</html>
