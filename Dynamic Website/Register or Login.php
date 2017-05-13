<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  include 'Validation.php';
?>

<body>

  <?php
    $menu = array('Home');
    pageHeader('Register or Login', $menu);
  ?>

  <form id="register" action="" method="post" novalidate>
    <h2>Register</h2>

    <label>Username</label>
    <?php
      if (!empty($_POST['register'])) {
        validateText($_POST, 'register_username', '/^[A-z]+$/', 9);
      }
    ?>
    <input type="text" name="register_username" class="input" oninvalid="this.setCustomValidity('Please enter a valid username')" oninput="setCustomValidity('')" pattern="^[A-z]+$" required>

    <label>Email</label>
    <?php
      if (!empty($_POST['register'])) {
        validateText($_POST, 'email', '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', 9);
      }
    ?>
    <input type="email" name="email" class="input" oninvalid="this.setCustomValidity('Please enter a valid email address')" oninput="setCustomValidity('')" required>

    <label for="date_of_birth">Date of Birth</label>
    <?php
      if (!empty($_POST['register'])) {
        validateDOB($_POST, 'date_of_birth');
      }
    ?>
    <input type="date" name="date_of_birth" class="input" min="1938-01-01" max="1998-12-31" oninvalid="this.setCustomValidity('You must be 18 or older')" oninput="setCustomValidity('')" required>

    <label for="age">Age</label>
    <?php
      if (!empty($_POST['register'])) {
        validateAge($_POST, 'age');
      }
    ?>
    <input type="number" name="age" class="input" min="18" max="79" oninvalid="this.setCustomValidity('You must be 18 or older')" oninput="setCustomValidity('')" required>

    <label>Gender</label>
    <?php
      if (!empty($_POST['register'])) {
        validateGender($_POST, 'gender');
      }
    ?>
    <div class="gender">
      <input type="radio" name="gender" value="male" required>
      <p class="radio_button">Male</p>
      <input type="radio" value="female" name="gender">
      <p class="radio_button">Female</p>
    </div>

    <label>Password</label>
    <?php
      if (!empty($_POST['register'])) {
        validatePassword($_POST, 'register_password', 9);
      }
    ?>
    <input type="password" name="register_password" class="input" required>

    <input type="submit" value="Register" name="register" class="button" id="register_button">
  </form>

  <form id="login" action="" method="post" novalidate>
    <h2>Login</h2>

    <label>Username</label>
    <?php
      if (!empty($_POST['login'])) {
        validateText($_POST, 'login_username', '/^[A-z]+$/', 6);
      }
    ?>
    <input type="email" name="login_username" class="input" oninvalid="this.setCustomValidity('Please enter a valid email address')" oninput="setCustomValidity('')" required>

    <label>Password</label>
    <?php
      if (!empty($_POST['login'])) {
        validatePassword($_POST, 'login_password', 6);
      }
    ?>
    <input type="password" name="login_password" class="input" required>

    <input type="submit" value="Login" name="login" class="button" id="login_button">
  </form>

    <p id="footer">Register to get notification of events held at nearby parks.</p>
</body>

</html>
