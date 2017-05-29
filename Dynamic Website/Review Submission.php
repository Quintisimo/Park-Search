<?php
  include 'PDO.php';

  //Checks if validation functions return true and if they do submits review data and average rating of each park to the database 
  if (validateRating() && validateReview()) {
    $review_data = $pdo->prepare('INSERT INTO reviews (id, name, reviewdate, username, rating, review) VALUES (:id, :name, :reviewdate, :username, :rating, :review)');
    $review_data->bindValue(':id', $_GET['id']);
    $review_data->bindValue(':name', $park_data['name']);
    $review_data->bindValue(':reviewdate', date("Y-m-d"));
    $review_data->bindValue(':username', $_SESSION['park_search']);
    $review_data->bindValue(':rating', $_POST['rating']);
    $review_data->bindValue(':review', $_POST['review']);
    $review_data->execute();

    $rating_data = $pdo->prepare('SELECT AVG(rating) FROM reviews WHERE id = :id');
    $rating_data->bindValue(':id', $_GET['id']);
    $rating_data->execute();
    $rating = $rating_data->fetch(PDO::FETCH_ASSOC);
    $average_rating = round($rating['AVG(rating)']);

    $park_rating = $pdo->prepare('UPDATE items SET averagerating = :averagerating WHERE id = :id');
    $park_rating->bindValue(':id', $_GET['id']);
    $park_rating->bindValue(':averagerating', $average_rating);
    $park_rating->execute();

    unset($_POST['rating']);
    unset($_POST['review']);
    unset($_POST['submit']);
  }
?>
