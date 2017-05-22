<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');

  if (validateUsername($_POST, 'register_username', 9) && validateEmail($_POST, 'email') && validateDOB($_POST, 'date_of_birth') && validateAge($_POST, 'age') && validateGender($_POST, 'gender') && validatePassword($_POST, 'register_password', 9)) {
    $salt = uniqid();
    $stmt = $pdo->prepare('INSERT INTO members (username, email, dateOfBirth, age, gender, salt, password) VALUES (:username, :email, :dateOfBirth, :age, :gender, :salt, SHA2(CONCAT(:password, salt), 0))');
    $stmt->bindValue(':username', $_POST['register_username']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':dateOfBirth', $_POST['date_of_birth']);
    $stmt->bindValue(':age', $_POST['age']);
    $stmt->bindValue(':gender', $_POST['gender']);
    $stmt->bindValue(':salt', $salt);
    $stmt->bindValue(':password', $_POST['register_password']);
    $stmt->execute();

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
