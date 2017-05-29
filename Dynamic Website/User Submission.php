<?php
  include 'PDO.php';

  //Checks if validation functions return true and if they do submits user data to the database
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

  //Checks if validation functions return true and if they do it logs in the user  
  if (validUsername() && validPassword()) {
    session_start();
    $_SESSION['park_search'] = $_POST['login_username'];

    echo '<dialog open class="messagebox" id="messagebox_login">You have successfully registered';
    echo '<input type="submit" value="OK" class="button" id="ok_button" onclick="redirectDialog()"></dialog>';

    unset($_POST['login_username']);
    unset($_POST['login_password']);
    unset($_POST['login']);
  }
?>
