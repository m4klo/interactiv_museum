<?php
require_once 'connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$checkedStyles = isset($_GET['checkedStyles']) ? $_GET['checkedStyles'] : [];

$query = "SELECT id, name FROM style";
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $query .= " WHERE name LIKE '%$searchTerm%'";
}
$result = mysqli_query($conn, $query);

$stylesList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $style_id = $row['id'];
    $style_name = $row['name'];
    $isChecked = in_array($style_id, $checkedStyles) ? 'checked' : '';
    $stylesList[] = array('id' => $style_id, 'name' => $style_name, 'isChecked' => $isChecked);
}
?>

<!-- Wygeneruj listę autorów -->
<?php foreach ($stylesList as $style): ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="<?= $style['id'] ?>" id="<?= $style['id'] ?>" <?= $style['isChecked'] ?>>
        <label class="form-check-label" for="<?= $style['id'] ?>">
            <?= $style['name'] ?>
        </label>
    </div>
<?php endforeach; ?>
