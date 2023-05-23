<?php
require_once 'connect.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$checkedAuthors = isset($_GET['checkedAuthors']) ? $_GET['checkedAuthors'] : [];

$query = "SELECT id, name FROM author";
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $query .= " WHERE name LIKE '%$searchTerm%'";
}
$result = mysqli_query($conn, $query);

$authorsList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $author_id = $row['id'];
    $author_name = $row['name'];
    $isChecked = in_array($author_id, $checkedAuthors) ? 'checked' : '';
    $authorsList[] = array('id' => $author_id, 'name' => $author_name, 'isChecked' => $isChecked);
}
?>

<!-- Wygeneruj listę autorów -->
<?php foreach ($authorsList as $author): ?>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="<?= $author['id'] ?>" id="<?= $author['id'] ?>" <?= $author['isChecked'] ?>>
        <label class="form-check-label" for="<?= $author['id'] ?>">
            <?= $author['name'] ?>
        </label>
    </div>
<?php endforeach; ?>
