<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');

  function validateUsername() {
    $regular_expression = '/^[A-z]+$/';
    $usernameList = $GLOBALS['pdo']->query('SELECT username FROM members');

    if (empty($_POST['register_username'])) {
      echo '<span class="error">Please enter a username</span>';
      return false;
    }

    if (!preg_match($regular_expression, $_POST['register_username']) || strlen($_POST['register_username']) > 45) {
      echo '<span class="error">Please enter a valid username</span>';
      return false;
    }

    foreach ($usernameList as $username) {
      if ($username['username'] == $_POST['register_username']) {
        echo '<span class="error">Username already exists</span>';
        return false;
      }
    }
    return true;
  }

  function validateEmail() {
    $regular_expression = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    $emailList = $GLOBALS['pdo']->query('SELECT email FROM members');

    if (empty($_POST['email'])) {
      echo "<span class=\"error\">Please enter an email address</span>";
      return false;

    }

    if (!preg_match($regular_expression, $_POST['email']) || strlen($_POST['email']) > 45) {
      echo "<span class=\"error\">Please enter a valid email address</span>";
      return false;
    }

    foreach ($emailList as $email) {
      if ($email['email'] == $_POST['email']) {
        echo "<span class=\"error\">The email address is already in use</span>";
        return false;
      }
    }
    return true;
  }

  function validateDOB() {
    if (empty($_POST['date_of_birth'])) {
      echo '<span class="error">Please enter your date of birth</span>';
      return false;

    }

    if (substr($_POST['date_of_birth'], 0, 4) < 1938 || substr($_POST['date_of_birth'], 0, 4) > 1998) {
      echo '<span class="error">You must be 18 or older</span>';
      return false;
    }
    return true;
  }

  function validateAge() {
    if (empty($_POST['age'])) {
      echo '<span class="error">Please enter your age</span>';
      return false;

    }

    if ($_POST['age'] < 18 || $_POST['age'] > 79) {
      echo '<span class="error">You must be 18 or older</span>';
      return false;
    }
    return true;
  }

  function validateGender() {
    if (empty($_POST['gender'])) {
      echo '<span class="error">Please select your gender</span>';
      return false;
    }
    return true;
  }

  function validatePassword() {
    if (empty($_POST['register_password'])) {
      echo '<span class="error">Please enter a password</span>';
      return false;
    }

    if (strlen($_POST['register_password']) < 6 || strlen($_POST['register_password']) > 45) {
      echo '<span class="error">Please enter a strong password</span>';
      return false;
    }
    return true;
  }

  function validUsername() {
    $fetchData = $GLOBALS['pdo']->query('SELECT username FROM members');
    $usernameList = array();

    foreach ($fetchData as $username) {
      $usernameList[] = $username[0];
    }

    if (empty($_POST['login_username'])) {
      echo '<span class="error">Please enter your username</span>';
      return false;
    }

    if (!in_array($_POST['login_username'], $usernameList)) {
      echo '<span class="error">Username is not registered</span>';
      return false;
    }
    return true;
  }

  function validPassword() {
    $fetchData = $GLOBALS['pdo']->prepare('SELECT salt, password FROM members WHERE username = :username');
    $fetchData->bindValue(':username', $_POST['login_username']);
    $fetchData->execute();
    $userData = $fetchData->fetch(PDO::FETCH_ASSOC);
    $salt = $userData['salt'];
    $storedHash = $userData['password'];
    $hashPassword = hash('sha256', $_POST['login_password'].$salt);

    if (empty($_POST['login_password'])) {
      echo '<span class="error">Please enter your password</span>';
      return false;
    }

    if ($hashPassword != $storedHash) {
      echo '<span class="error">Your password is incorrect</span>';
      return false;
    }
    return true;
  }

  function saveValue($field_list, $field_name) {
    if (isset($field_list[$field_name])) {
      echo htmlspecialchars($field_list[$field_name]);
    }
  }
?>
