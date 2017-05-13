<?php
  function validateText($field_list, $field_name, $regular_expression, $normalize_length) {
    if (empty($field_list[$field_name]) == true) {

      if (strlen($field_name) > 5){
        $normalize_fieldname = substr($field_name, $normalize_length);
        echo "<p class=\"error\">Please enter your $normalize_fieldname</p>";
      } else {
        echo "<p class=\"error\">Please enter your $field_name</p>";
      }

    } elseif (!preg_match($regular_expression, $field_list[$field_name])) {

      if (strlen($field_name) > 5) {
        $normalize_fieldname = substr($field_name, $normalize_length);
        echo "<p class=\"error\">Please enter your valid $normalize_fieldname</p>";
      } else {
        echo "<p class=\"error\">Please enter your valid $field_name</p>";
      }
    }
  }

  function validateDOB($field_list, $field_name) {
    if (empty($field_list[$field_name]) == true) {
      $normalize_fieldname = str_replace('_', ' ', $field_name);
      echo "<p class=\"error\">Please enter your $normalize_fieldname</p>";
    } elseif (substr($field_list[$field_name], 0, 4) < 1938 || substr($field_list[$field_name], 0, 4) > 1998) {
      echo "<p class=\"error\">You must be 18 or older</p>";
    }
  }

  function validateAge($field_list, $field_name) {
    if (empty($field_list[$field_name]) == true) {
      echo "<p class=\"error\">Please enter your age</p>";
    } elseif ($field_list[$field_name] < 18 || $field_list[$field_name] > 79) {
      echo "<p class=\"error\">You must be 18 or older</p>";
    }
  }

  function validateGender($field_list, $field_name) {
    if (empty($field_list[$field_name]) == true) {
      echo "<p class=\"error\">Please select your gender</p>";
    }
  }

  function validatePassword($field_list, $field_name, $normalize_length) {
    if (empty($field_list[$field_name]) == true) {
      $normalize_fieldname = substr($field_name, $normalize_length);
      echo "<p class=\"error\">Please enter your $normalize_fieldname</p>";
    } elseif (strlen($field_list[$field_name]) < 6) {
      echo "<p class=\"error\">Please enter your strong password";
    }
  }
?>
