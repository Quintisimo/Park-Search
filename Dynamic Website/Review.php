<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  include 'Park.php';
  pageHead('map');
?>

<?php
  echo "<body onload=\"initMap($parkData[latitude], $parkData[longitude])\">";
  session_start();

  if (!empty($_SESSION)) {
    $menu = array('Home', 'Logout');
  } else {
    $menu = array('Home', 'Register or Login');
  }
  pageHeader($parkData['name'], $menu);
?>

  <div id="content">
    <a class="back_button" onclick="goBack()">Go back to search results</a>
    <div id="map"></div>
    <h2>Park information</h2>
    <?php
      echo "<p>$street</p>";
    ?>
  </div>

  <div id="reviews">
    <table class="reviews">

      <tr>
        <th>Date</th>
        <th>User reviews and ratings</th>
      </tr>

      <tr>
        <td>14/04/2017</td>
        <td>Jacob<br>Park is not well maintained<br><i>2 stars</i></td>
      </tr>

      <tr>
        <td>13/04/2017</td>
        <td>Quintus<br>Park is great for kids<br><i>4 stars</i></td>
      </tr>

    </table>

    <form>
      <textarea rows="4" cols="51" placeholder="Write a review for this park.." required></textarea>
      <input type="submit" value="Review" class="button" id="review_button">
    </form>
  </div>

  <footer>Hope you have a wonderful at the park</footer>
</body>

</html>
