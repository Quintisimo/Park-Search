<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');

  if (validateUsername() && validateEmail() && validateDOB() && validateAge() && validateGender() && validatePassword()) {
    $salt = uniqid();
    $users_data = $pdo->prepare('INSERT INTO members (username, email, dateofbirth, age, gender, salt, password) VALUES (:username, :email, :dateofbirth, :age, :gender, :salt, SHA2(CONCAT(:password, salt), 0))');
    $users_data->bindValue(':username', $_POST['register_username']);
    $users_data->bindValue(':email', $_POST['email']);
    $users_data->bindValue(':dateofbirth', $_POST['date_of_birth']);
    $users_data->bindValue(':age', $_POST['age']);
    $users_data->bindValue(':gender', $_POST['gender']);
    $users_data->bindValue(':salt', $salt);
    $users_data->bindValue(':password', $_POST['register_password']);
    $users_data->execute();

    echo '<dialog open class="messagebox" id="messagebox_register">You have successfully registered';
    echo '<input type="submit" value="OK" class="button" id="ok_button" onclick="closeDialog()"></dialog>';

    unset($_POST['register_username']);
    unset($_POST['email']);
    unset($_POST['date_of_birth']);
    unset($_POST['age']);
    unset($_POST['gender']);
    unset($_POST['register_password']);
    unset($_POST['register']);
  }

  if (validUsername() && validPassword()) {
    session_start();
    $_SESSION['park_search'] = $_POST['login_username'];

    echo '<dialog open class="messagebox" id="messagebox_login">You have successfully registered';
    echo '<input type="submit" value="OK" class="button" id="ok_button" onclick="redirectDialog()"></dialog>';

    unset($_POST['login_username']);
    unset($_POST['login_password']);
    unset($_POST['login']);
  }

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
