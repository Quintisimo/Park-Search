<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  include 'Validation.php';
  include 'PDO.php';
  pageHead('map');
  session_start();

  if (isset($_GET['id'])) {
    $result = $pdo->prepare('SELECT name, street, suburb, latitude, longitude FROM items WHERE id = :id');
    $result->bindValue(':id', $_GET['id']);
    $result->execute();
    $park_data = $result->fetch(PDO::FETCH_ASSOC);
    $street = strtolower($park_data['street']);
    $name = strtolower($park_data['name']);
    $suburb = strtolower($park_data['suburb']);
  }
  include 'Database Submission.php';

  echo "<body onload=\"initMap($park_data[latitude], $park_data[longitude])\">";

  if (!empty($_SESSION['park_search'])) {
    $menu = array('Home', 'Logout');
  } else {
    $menu = array('Home', 'Register or Login');
  }
  pageHeader($name, $menu);
?>

  <div id="content">
    <a class="back_button" id="previous_page" onclick="goBack()">Go back to search results</a>
    <div id="individual_map"></div>
    <h2>Park information</h2>
    <?php
      echo "<span>$street</span><br>";
      echo "<span>$suburb</span>";
    ?>
  </div>

  <div id="reviews">
    <table>
      <tr>
        <th>Date</th>
        <th>User reviews and ratings</th>
      </tr>

      <?php
        $review_data = $pdo->prepare('SELECT reviewdate, username, rating, review FROM reviews WHERE id = :id');
        $review_data->bindValue(':id', $_GET['id']);
        $review_data->execute();

        foreach($review_data as $review) {
          echo '<tr>';
          echo "<td>$review[reviewdate]</td>";
          echo "<td>$review[username]<br>$review[review]<br><i>$review[rating] stars</i></td>";
          echo '</tr>';
        }
      ?>
      
    </table>

    <?php if (!empty($_SESSION['park_search'])) { ?>
      <form action="" method="post">
        <label for="rating" id="rating_label">Rate your experience</label>
        <?php
          if (!empty($_POST['submit'])) {
            validateRating();
          }
        ?>
        <div id="rating">
          <input type="radio" name="rating" value="1" id="one" required><label for="one">1</label>
          <input type="radio" name="rating" value="2" id="two" required><label for="two">2</label>
          <input type="radio" name="rating" value="3" id="three" required><label for="three">3</label>
          <input type="radio" name="rating" value="4" id="four" required><label for="four">4</label>
          <input type="radio" name="rating" value="5" id="five" required><label for="five">5</label>
        </div>

        <?php
          if (!empty($_POST['submit'])) {
            validateReview();
          }
        ?>
        <textarea rows="4" cols="51" name="review" placeholder="Write a review for this park.." oninvalid="this.setCustomValidity('Only text allowed')" oninput="setCustomValidity('')" required><?php saveValue($_POST, 'review'); ?></textarea>

        <input type="submit" name="submit" value="Submit" class="button" id="review_button">
      </form>
    <?php } ?>
  </div>

  <footer>Hope you have a wonderful at the park</footer>
</body>

</html>
