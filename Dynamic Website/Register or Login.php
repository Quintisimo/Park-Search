<!DOCTYPE html>
<html>

<?php
  include 'Template.php';
  include 'Validation.php';
  include 'User Submission.php';
  //Generates page header
  pageHead();
?>

<body>

  <?php
    if (!empty($_SESSION['park_search'])) {
      $menu = array('Home', 'Logout');
    } else {
      $menu = array('Home');
    }
    //Generates page heading
    pageHeader('Register or Login', $menu);
  ?>

  <form id="register" action="" method="post">
    <h2>Register</h2>

    <label>Username</label>
    <?php
      if (isset($_POST['register'])) {
        //Performs server side validation on register username input field
        validateUsername();
      }
    ?>
    <input type="text" name="register_username" value="<?php saveValue($_POST, 'register_username'); ?>" class="input" oninvalid="this.setCustomValidity('Please enter a valid username')" oninput="setCustomValidity('')" pattern="^[A-z]+$" required>

    <label>Email</label>
    <?php
      if (isset($_POST['register'])) {
        //Performs server side validation on email input field
        validateEmail();
      }
    ?>
    <input type="email" name="email" value="<?php saveValue($_POST, 'email'); ?>" class="input" oninvalid="this.setCustomValidity('Please enter a valid email address')" oninput="setCustomValidity('')" required>

    <label for="date_of_birth">Date of Birth</label>
    <?php
      if (isset($_POST['register'])) {
        //Performs server side validation on date of birth input field
        validateDOB();
      }
    ?>
    <input type="date" name="date_of_birth" value="<?php saveValue($_POST, 'date_of_birth'); ?>" class="input" min="1938-01-01" max="1998-12-31" oninvalid="this.setCustomValidity('You must be 18 or older')" oninput="setCustomValidity('')" required>

    <label for="age">Age</label>
    <?php
      if (isset($_POST['register'])) {
        //Performs server side validation on age input field
        validateAge();
      }
    ?>
    <input type="number" name="age" value="<?php saveValue($_POST, 'age'); ?>" class="input" min="18" max="79" oninvalid="this.setCustomValidity('You must be 18 or older')" oninput="setCustomValidity('')" required>

    <label>Gender</label>
    <?php
      if (isset($_POST['register'])) {
        //Performs server side validation on gender input field
        validateGender();
      }
    ?>
    <div class="gender">
      <input type="radio" name="gender" value="male" required>
      <p class="radio_button">Male</p>
      <input type="radio" name="gender" value="female">
      <p class="radio_button">Female</p>
    </div>

    <label>Password</label>
    <?php
      if (isset($_POST['register'])) {
        //Performs server side validation on register password input field
        validatePassword();
      }
    ?>
    <input type="password" name="register_password" value="<?php saveValue($_POST, 'register_password'); ?>" class="input" required>

    <input type="submit" value="Register" name="register" class="button" id="register_button">
  </form>

  <form id="login" action="" method="post">
    <h2>Login</h2>

    <label>Username</label>
    <?php
      if (isset($_POST['login'])) {
        //Performs server side validation on login username input field
        validUsername();
      }
    ?>
    <input type="text" name="login_username" value="<?php saveValue($_POST, 'login_username'); ?>" class="input" oninvalid="this.setCustomValidity('Please enter a valid username')" oninput="setCustomValidity('')"  pattern="^[A-z]+$" required>

    <label>Password</label>
    <?php
      if (isset($_POST['login'])) {
        //Performs server side validation on login password input field
        validPassword();
      }
    ?>
    <input type="password" name="login_password" value="<?php saveValue($_POST, 'login_password'); ?>" class="input" required>

    <input type="submit" value="Login" name="login" class="button" id="login_button">
  </form>

    <footer>Register to get notification of events held at nearby parks</footer>
</body>

</html>
