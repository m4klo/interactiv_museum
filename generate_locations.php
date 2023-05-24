<?php
require_once 'connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$checkedLocations = isset($_GET['checkedLocations']) ? $_GET['checkedLocations'] : [];

$query = "SELECT id, name FROM location";
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $query .= " WHERE name LIKE '%$searchTerm%'";
}
$result = mysqli_query($conn, $query);

$locationsList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $location_id = $row['id'];
    $location_name = $row['name'];
    $isChecked = in_array($location_id, $checkedLocations) ? 'checked' : '';
    $locationsList[] = array('id' => $location_id, 'name' => $location_name, 'isChecked' => $isChecked);
}
?>

<!-- Wygeneruj listę lokalizacji -->
<?php foreach ($locationsList as $location): ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="<?= $location['id'] ?>" id="<?= $location['id'] ?>" <?= $location['isChecked'] ?>>
        <label class="form-check-label" for="<?= $location['id'] ?>">
            <?= $location['name'] ?>
        </label>
    </div>
<?php endforeach; ?>