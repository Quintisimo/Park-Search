<?php
  include 'Template.php';
  pageHead();
  session_start();
  session_unset();
  session_destroy();
  echo '<div id="logout">';
  echo '<h2>You have been logged out</h2>';
  echo '<a href="home.php" class="back_button">Go Home</a>';
  echo '<img src="Images/Logout.jpg" alt="Park Image">';
  echo '</div>';
?>
