<!DOCTYPE html>
<html>

<?php
include 'Template.php';
?>

<body>
  <?php
  $menu = array('Home');
  page_header('Register or Login', $menu);
  ?>
  <form id="register">
    <h2>Register</h2>
    <label>Username</label>
    <input type="text" name="username" oninvalid="this.setCustomValidity('Please enter valid username')" oninput="setCustomValidity('')" class="input" required pattern="^[A-z]+$">
    <label for="register_email">Email</label>
    <input type="email" name="email" oninvalid="this.setCustomValidity('Please enter valid email address')" oninput="setCustomValidity('')" class="input" required>
    <label for="date_of_birth">Date of Birth</label>
    <input type="date" name="date_of_birth" min="1973-01-01" max="1998-12-31" oninvalid="this.setCustomValidity('You must be 18 or older')" oninput="setCustomValidity('')" class="input" required>
    <label for="age">Age</label>
    <input type="number" name="age" min="18" max="99" oninvalid="this.setCustomValidity('You must be 18 or older')" oninput="setCustomValidity('')" class="input" required>
    <label>Gender</label>
    <input type="radio" name="male" required>
    <p class="radio_button">Male</p>
    <input type="radio" name="female">
    <p class="radio_button">Female</p>
    <label>Password</label>
    <input type="password" class="input" required>
    <input type="submit" value="Register" class="button" id="register_button">
  </form>
  <form id="login">
    <h2>Login</h2>
    <label>Username</label>
    <input type="email" name="username_login" class="input" oninvalid="this.setCustomValidity('Please enter valid email address')" oninput="setCustomValidity('')" required>
    <label>Password</label>
    <input type="password" name="login_password" class="input" required>
    <input type="submit" value="Login" class="button" id="login_button">
  </form>
    <p id="footer">Register to get notification of events held at nearby parks.</p>
</body>

</html>
