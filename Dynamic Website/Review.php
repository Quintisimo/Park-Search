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

    <?php if (!empty($_SESSION)) { ?>
      <form action="" method="post">
        <label for="rating" id="rating_label">Rate your experience</label>
        <div id="rating">
          <input type="radio" name="rating" value="1" id="one" required><label for="one">1</label>
          <input type="radio" name="rating" value="2" id="two" required><label for="two">2</label>
          <input type="radio" name="rating" value="3" id="three" required><label for="three">3</label>
          <input type="radio" name="rating" value="4" id="four" required><label for="four">4</label>
          <input type="radio" name="rating" value="5" id="five" required><label for="five">5</label>
        </div>

        <textarea rows="4" cols="51" name="review" placeholder="Write a review for this park.." required></textarea>

        <input type="submit" name="submit" value="Submit" class="button" id="review_button">
      </form>
    <?php } ?>
  </div>

  <footer>Hope you have a wonderful at the park</footer>
</body>

</html>
