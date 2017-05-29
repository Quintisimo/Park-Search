<?php
  include 'PDO.php';

  //Validates register username field
  function validateUsername() {
    $regular_expression = '/^[A-z]+$/';
    $username_list = $GLOBALS['pdo']->query('SELECT username FROM members');

    //Checks if username field is empty
    if (empty($_POST['register_username'])) {
      echo '<span class="error">Please enter a username</span>';
      return false;
    }

    //Checks if username only contains text
    if (!preg_match($regular_expression, $_POST['register_username']) || strlen($_POST['register_username']) > 45) {
      echo '<span class="error">Please enter a valid username</span>';
      return false;
    }

    //Checks that the username doesn't already exist in the database
    foreach ($username_list as $username) {
      if ($username['username'] == $_POST['register_username']) {
        echo '<span class="error">Username already exists</span>';
        return false;
      }
    }
    return true;
  }

  //Validates email field
  function validateEmail() {
    $regular_expression = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    $email_list = $GLOBALS['pdo']->query('SELECT email FROM members');

    //Checks if email field is empty
    if (empty($_POST['email'])) {
      echo '<span class="error">Please enter an email address</span>';
      return false;
    }

    //Checks if email has the correct format
    if (!preg_match($regular_expression, $_POST['email']) || strlen($_POST['email']) > 45) {
      echo '<span class="error">Please enter a valid email address</span>';
      return false;
    }

    //Checks that email address doesn't already exist in the database
    foreach ($email_list as $email) {
      if ($email['email'] == $_POST['email']) {
        echo '<span class="error">The email address is already in use</span>';
        return false;
      }
    }
    return true;
  }

  //Validates date of birth field
  function validateDOB() {
    //Checks if date of birth field is empty
    if (empty($_POST['date_of_birth'])) {
      echo '<span class="error">Please enter your date of birth</span>';
      return false;

    }

    //Checks that the user is between 18 and 79 years old
    if (substr($_POST['date_of_birth'], 0, 4) < 1938 || substr($_POST['date_of_birth'], 0, 4) > 1998) {
      echo '<span class="error">You must be 18 or older</span>';
      return false;
    }
    return true;
  }

  //Validates age field
  function validateAge() {
    //Checks if age field is empty
    if (empty($_POST['age'])) {
      echo '<span class="error">Please enter your age</span>';
      return false;

    }

    //Checks that the user is between 18 and 79 years old
    if ($_POST['age'] < 18 || $_POST['age'] > 79) {
      echo '<span class="error">You must be 18 or older</span>';
      return false;
    }
    return true;
  }

  //Validates age field
  function validateGender() {
    //Checks if the gender field is empty
    if (empty($_POST['gender'])) {
      echo '<span class="error">Please select your gender</span>';
      return false;
    }
    return true;
  }

  //Validates register password field
  function validatePassword() {
    //Checks if register password field is empty
    if (empty($_POST['register_password'])) {
      echo '<span class="error">Please enter a password</span>';
      return false;
    }

    //Checks that register password is between 6 and 45 characters long
    if (strlen($_POST['register_password']) < 6 || strlen($_POST['register_password']) > 45) {
      echo '<span class="error">Please enter a strong password</span>';
      return false;
    }
    return true;
  }

  //Validates login username field
  function validUsername() {
    $username_data = $GLOBALS['pdo']->query('SELECT username FROM members');
    $username_list = array();

    foreach ($username_data as $username) {
      $username_list[] = $username[0];
    }

    //Checks if login username login field is empty
    if (empty($_POST['login_username'])) {
      echo '<span class="error">Please enter your username</span>';
      return false;
    }

    //Checks if login username exits in the database
    if (!in_array($_POST['login_username'], $username_list)) {
      echo '<span class="error">Username is not registered</span>';
      return false;
    }
    return true;
  }

  //Validates login password field
  function validPassword() {
    $username_data = $GLOBALS['pdo']->prepare('SELECT salt, password FROM members WHERE username = :username');
    $username_data->bindValue(':username', $_POST['login_username']);
    $username_data->execute();
    $user_data = $username_data->fetch(PDO::FETCH_ASSOC);
    $salt = $user_data['salt'];
    $storedHash = $user_data['password'];
    $hashPassword = hash('sha256', $_POST['login_password'].$salt);

    //Checks if login password field is empty
    if (empty($_POST['login_password'])) {
      echo '<span class="error">Please enter your password</span>';
      return false;
    }

    //Checks if login password matchs the password stored in the databse for the respective user
    if ($hashPassword != $storedHash) {
      echo '<span class="error">Your password is incorrect</span>';
      return false;
    }
    return true;
  }

  //Save the input fields value on page refresh
  function saveValue($field_list, $field_name) {
    if (isset($field_list[$field_name])) {
      echo htmlspecialchars($field_list[$field_name]);
    }
  }

  //Validates rating field
  function validateRating() {
    //Checks if rating field is empty
    if (empty($_POST['rating'])) {
      echo '<span class="error">Please select a rating</span>';
    }
    return true;
  }

  //Validates review field
  function validateReview() {
    $regular_expression = '/^[A-z\s]+$/';
    $user_data = $GLOBALS['pdo']->query('SELECT name, username FROM reviews');
    $park_list = $GLOBALS['pdo']->prepare('SELECT name FROM items WHERE id = :id');
    $park_list->bindValue(':id', $_GET['id']);
    $park_list->execute();
    $park_data = $park_list->fetch(PDO::FETCH_ASSOC);

    //Checks if review field is empty
    if (empty($_POST['review'])) {
      echo '<span class="error">Please enter a review</span>';
      return false;
    }

    //Checks that review field only contains text and spaces
    if (!preg_match($regular_expression, $_POST['review'])) {
      echo '<span class="error">Only text allowed</span>';
      return false;
    }

    foreach ($user_data as $data) {
      if ($data['name'] == $park_data['name'] && $data['username'] == $_SESSION['park_search']) {
        echo '<span class="error">One review per user</span>';
        return false;
      }
    }
    return true;
  }
?>
