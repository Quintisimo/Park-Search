<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  pageHead('map');
?>

<body>
  <?php
  session_start();

  if (!empty($_SESSION) == true) {
    $menu = array('Home', 'Logout');
  } else {
    $menu = array('Home', 'Register or Login');
  }
  pageHeader('', $menu);
  ?>

  <div id="content">
    <a href="Results.php" class="back_button">Go back to search results</a>
    <div id="map"></div>
    <h2>Park information</h2>

    <table class="reviews">

      <tr>
        <th>Things to do</th>
        <td>Playground, bike track, barbecue</td>
      </tr>

      <tr>
        <th>Suburb</th>
        <td>Chermside</td>
      </tr>

      <tr>
        <th>Rating</th>
        <td>3 stars</td>
      </tr>

    </table>
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
