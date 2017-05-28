<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  pageHead();
  session_start();
?>

<body>
  <?php
    $_SESSION = array();
    session_destroy();

    $menu = array('Home', 'Register or Login');
    pageHeader('You have been logged out', $menu);
  ?>

  <h1 class="logout">Hope you have a great day</h1>
  <footer>See you again soon</footer>
</body>

</html>
