<!DOCTYPE html>
<html>

<?php
  session_start();
  include 'Template.php';
  include 'Validation.php';
  include 'PDO.php';
  pageHead('map');

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

  echo "<body onload=\"individualMap($park_data[latitude], $park_data[longitude])\">";

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
    <h2>Park Address</h2>
    <?php
      echo '<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">';
      echo "<meta itemprop=\"latitude\" content=\"$park_data[latitude]\" />";
      echo "<meta itemprop=\"longitude\" content=\"$park_data[longitude]\" />";
      echo '</div>';
      echo '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
      echo "<span itemprop=\"streetAddress\">$street</span><br>";
      echo "<span itemprop=\"addressLocality\">$suburb</span>";
      echo '</div>';
    ?>
  </div>

  <div id="reviews">
    <div itemprop="review" itemscope itemtype="http://schema.org/Review">
      <?php
        $review_data = $pdo->prepare('SELECT reviewdate, username, rating, review FROM reviews WHERE id = :id');
        $review_data->bindValue(':id', $_GET['id']);
        $review_data->execute();

        if ($review_data->rowCount() > 0) {
          echo '<table>';
          echo '<tr>';
          echo '<th>Date</th>';
          echo '<th>User reviews and ratings</th>';
          echo '</tr>';
          echo "<meta itemprop=\"itemReviewed\" content=\"$name\" />";

          foreach($review_data as $review) {
            echo '<tr>';
            echo "<td>$review[reviewdate]</td>";
            echo "<td><span itemprop=\"author\">$review[username]</span><br>";
            echo "<span class=\"nocaps\" itemprop=\"reviewBody\">$review[review]</span><br>";
            echo "<div itemprop=\"reviewRating\" itemscope itemtype=\"http://schema.org/Rating\">";
            echo "<i><span itemprop=\"ratingValue\">$review[rating]</span> stars</i></div></td>";
            echo '</tr>';
          }
          echo '</table>';
        } elseif (empty($_SESSION['park_search'])) {
          echo '<h2>Login in to leave a review</h2>';
        }
      ?>
    </div>

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
