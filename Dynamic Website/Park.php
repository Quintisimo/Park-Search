<?php
  if (isset($_GET['id'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
    $result = $pdo->prepare('SELECT name, street, latitude, longitude FROM parks WHERE id = :id');
    $result->bindValue(':id', $_GET['id']);
    $result->execute();
    $parkData = $result->fetch(PDO::FETCH_ASSOC);
    $street = strtolower($parkData['street']);
  }
?>
