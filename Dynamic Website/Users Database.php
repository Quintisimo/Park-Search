<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');

  if (validateUsername($_POST, 'register_username', 9) && validateEmail($_POST, 'email') && validateDOB($_POST, 'date_of_birth') && validateAge($_POST, 'age') && validateGender($_POST, 'gender') && validatePassword($_POST, 'register_password', 9)) {
    $salt = uniqid();
    $usersData = $pdo->prepare('INSERT INTO members (username, email, dateOfBirth, age, gender, salt, password) VALUES (:username, :email, :dateOfBirth, :age, :gender, :salt, SHA2(CONCAT(:password, salt), 0))');
    $usersData->bindValue(':username', $_POST['register_username']);
    $usersData->bindValue(':email', $_POST['email']);
    $usersData->bindValue(':dateOfBirth', $_POST['date_of_birth']);
    $usersData->bindValue(':age', $_POST['age']);
    $usersData->bindValue(':gender', $_POST['gender']);
    $usersData->bindValue(':salt', $salt);
    $usersData->bindValue(':password', $_POST['register_password']);
    $usersData->execute();

    echo '<dialog open class="messagebox" id="messagebox_register">You have successfully registered';
    echo '<input type="submit" value="OK" class="button" id="ok_button" onclick="closeDialog()"></dialog>';

    $_POST['register_username'] = null;
    $_POST['email'] = null;
    $_POST['date_of_birth'] = null;
    $_POST['age'] = null;
    $_POST['gender'] = null;
    $_POST['register_password'] = null;
    $_POST['register'] = null;
  }

  if (validUsername($_POST, 'login_username') && validPassword($_POST, 'login_password')) {
    session_start();
    $_SESSION[$_POST['login_username']] = true;
    echo '<dialog open class="messagebox" id="messagebox_login">You have successfully logged in';
    echo '<input type="submit" value="OK" class="button" id="ok_button" onclick="redirectDialog()"></dialog>';

    $_POST['login_username'] = null;
    $_POST['login_password'] = null;
    $_POST['login'] = null;
  }
?>
