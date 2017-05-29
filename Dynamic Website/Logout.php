<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'Template.php';
  // Generates page header
  pageHead();
?>

<body>
  <?php
    //Logs the user out
    $_SESSION = array();
    session_destroy();

    $menu = array('Home', 'Register or Login');
    // Generates page heading
    pageHeader('You have been logged out', $menu);
  ?>

  <h1 class="logout">Hope you have a great day</h1>
  <footer>See you again soon</footer>
</body>

</html>
