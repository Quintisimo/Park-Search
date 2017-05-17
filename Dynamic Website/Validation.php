<?php
  function validateUsername($field_list, $field_name) {
    $regular_expression = '/^[A-z]+$/';
    $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
    $usersDatabase = $pdo->query('SELECT username FROM registered_users');
    $pronoun = pronounSet($field_name);

    if (empty($field_list[$field_name]) == true) {
      echo "<span class=\"error\">Please enter $pronoun username</span>";
      return false;

    }

    if (!preg_match($regular_expression, $field_list[$field_name])) {
      echo "<span class=\"error\">Please enter $pronoun valid username</span>";
      return false;
    }

    foreach ($usersDatabase as $username) {
      if ($username['username'] == $field_list[$field_name]) {
        echo '<span class="error">Username already exists</span>';
        return false;
      }
    }
    return true;
  }

  function validateEmail($field_list, $field_name) {
    $regular_expression = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
    $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
    $usersDatabase = $pdo->query('SELECT email FROM registered_users');

    if (empty($field_list[$field_name]) == true) {
      echo "<span class=\"error\">Please enter an $field_name address</span>";
      return false;

    }

    if (!preg_match($regular_expression, $field_list[$field_name])) {
      echo "<span class=\"error\">Please enter a valid $field_name address</span>";
      return false;
    }

    foreach ($usersDatabase as $email) {
      if ($email['email'] == $field_list[$field_name]) {
        echo "<span class=\"error\">The $field_name is already in use</span>";
        return false;
      }
    }
    return true;
  }

  function validateDOB($field_list, $field_name) {
    if (empty($field_list[$field_name]) == true) {
      echo '<span class="error">Please enter your date of birth</span>';
      return false;

    }

    if (substr($field_list[$field_name], 0, 4) < 1938 || substr($field_list[$field_name], 0, 4) > 1998) {
      echo '<span class="error">You must be 18 or older</span>';
      return false;
    }
    return true;
  }

  function validateAge($field_list, $field_name) {
    if (empty($field_list[$field_name]) == true) {
      echo '<span class="error">Please enter your age</span>';
      return false;

    }

    if ($field_list[$field_name] < 18 || $field_list[$field_name] > 79) {
      echo '<span class="error">You must be 18 or older</span>';
      return false;
    }
    return true;
  }

  function validateGender($field_list, $field_name) {
    if (empty($field_list[$field_name]) == true) {
      echo '<span class="error">Please select your gender</span>';
      return false;
    }
    return true;
  }

  function validatePassword($field_list, $field_name) {
    $pronoun = pronounSet($field_name);

    if (empty($field_list[$field_name]) == true) {
      echo "<span class=\"error\">Please enter $pronoun password</span>";
      return false;

    }

    if (strlen($field_list[$field_name]) < 6 || strlen($field_list[$field_name]) > 45) {
      echo "<span class=\"error\">Please enter $pronoun strong password</span>";
      return false;
    }
    return true;
  }

  function saveValue($field_list, $field_name) {
    if (isset($field_list[$field_name])) {
      echo htmlspecialchars($field_list[$field_name]);
    }
  }

  function pronounSet($field_name) {
    if (strpos($field_name, 'register') !== false) {
      return 'a';
    } elseif (strpos($field_name, 'login') !== false) {
      return 'your';
    }
  }
?>