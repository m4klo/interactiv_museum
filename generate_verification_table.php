<?php
require_once 'connect.php';

$query = "SELECT c.id, c.name, c.surname, c.login, c.email, l.name AS location_name FROM curator c
JOIN location l ON l.id = c.id_location
WHERE status LIKE 'niezatwierdzony'";
$result = mysqli_query($conn, $query);

$unverifiedCuratorsList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $curator_id = $row['id'];
    $curator_name = $row['name'];
    $curator_surname = $row['surname'];
    $curator_login = $row['login'];
    $curator_email = $row['email'];
    $curator_location_name = $row['location_name'];
    $unverifiedCuratorsList[] = array('id' => $curator_id, 'name' => $curator_name, 'surname' => $curator_surname, 'login' => $curator_login, 'email' => $curator_email, 'location_name' => $curator_location_name);
}


?>
<script src="script_verify.js"></script>
<link rel="stylesheet" href="style_table.css">
<table class="admin-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Imię</th>
      <th>Nazwisko</th>
      <th>Login</th>
      <th>Email</th>
      <th>Lokalizacja</th>
      <th>Akcje</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($unverifiedCuratorsList as $curator) { ?>
      <tr>
        <td><?php echo $curator['id']; ?></td>
        <td><?php echo $curator['name']; ?></td>
        <td><?php echo $curator['surname']; ?></td>
        <td><?php echo $curator['login']; ?></td>
        <td><?php echo $curator['email']; ?></td>
        <td><?php echo $curator['location_name']; ?></td>
        <td>
          <button onclick="verifyCurator(<?php echo $curator['id']; ?>);getVerificationTable();">Akceptuj</button>
          <button onclick="rejectCurator(<?php echo $curator['id']; ?>);getVerificationTable();">Odrzuć</button>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>