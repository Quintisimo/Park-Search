<?php
  $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (validateUsername($_POST, 'register_username', 9) == true && validateEmail($_POST, 'email') == true && validateDOB($_POST, 'date_of_birth') == true && validateAge($_POST, 'age') == true && validateGender($_POST, 'gender') == true && validatePassword($_POST, 'register_password', 9) == true) {
    $salt = uniqid();
    $stmt = $pdo->prepare('INSERT INTO registered_users (username, email, dateOfBirth, age, gender, salt, password) VALUES (:username, :email, :dateOfBirth, :age, :gender, :salt, SHA2(CONCAT(:password, salt), 0))');
    $stmt->bindValue(':username', $_POST['register_username']);
    $stmt->bindValue(':email', $_POST['email']);
    $stmt->bindValue(':dateOfBirth', $_POST['date_of_birth']);
    $stmt->bindValue(':age', $_POST['age']);
    $stmt->bindValue(':gender', $_POST['gender']);
    $stmt->bindValue(':salt', $salt);
    $stmt->bindValue(':password', $_POST['register_password']);
    $stmt->execute();

    $_POST['register_username'] = null;
    $_POST['email'] = null;
    $_POST['date_of_birth'] = null;
    $_POST['age'] = null;
    $_POST['gender'] = null;
    $_POST['register_password'] = null;
    $_POST['register'] = null;
  }
?>
