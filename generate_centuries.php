<?php
require_once 'connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$checkedCenturies = isset($_GET['checkedCenturies']) ? $_GET['checkedCenturies'] : [];

$query = "SELECT id, age FROM century";
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $query .= " WHERE age LIKE '%$searchTerm%'";
}
$result = mysqli_query($conn, $query);

$centuriesList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $century_id = $row['id'];
    $century_age = $row['age'];
    $isChecked = in_array($century_id, $checkedCenturies) ? 'checked' : '';
    $centuriesList[] = array('id' => $century_id, 'age' => $century_age, 'isChecked' => $isChecked);
}
?>

<!-- Wygeneruj listę autorów -->
<?php foreach ($centuriesList as $century): ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="<?= $century['id'] ?>" id="<?= $century['id'] ?>" <?= $century['isChecked'] ?>>
        <label class="form-check-label" for="<?= $century['id'] ?>">
            <?= $century['age'] ?>
        </label>
    </div>
<?php endforeach; ?>
