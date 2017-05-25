<?php
  function nameSearch() {
    $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
    $result = $pdo->prepare('SELECT id, name, street FROM parks WHERE name LIKE :name');
    $result->bindValue(':name', "%$_GET[name_search]%");
    $result->execute();

    if ($result->rowCount() > 0) {

      foreach ($result as $row) {
        $name = strtolower($row['name']);
        $street = strtolower($row['street']);
        echo '<tr>';
        echo "<td>$name<br>";
        echo "<a href=\"individualPark.php?id=$row[id]\">See reviews</a></td>";
        echo "<td>$street</td>";
        echo '</tr>';
      }

    } else {
      echo '<b>No results found for: </b>' .$name;
    }
  }

  function suburbSearch() {
    $pdo = new PDO('mysql:host=localhost;dbname=n9703578', 'n9703578', 'I_am_19_years_old.');
    $result = $pdo->prepare('SELECT id, name, street FROM parks WHERE suburb = :suburb');
    $result->bindValue(':suburb', $_GET['suburb_search']);
    $result->execute();

    foreach ($result as $row) {
      $name = strtolower($row['name']);
      $street = strtolower($row['street']);
      echo '<tr>';
      echo "<td>$name<br>";
      echo "<a href=\"individualPark.php?id=$row[id]\">See reviews</a></td>";
      echo "<td>$street</td>";
      echo '</tr>';
    }
  }
?>
