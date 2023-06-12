<?php
require_once 'connect.php';

$query = "SELECT id, name FROM author";
$result = mysqli_query($conn, $query);

$authorsList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $author_id = $row['id'];
    $author_name = $row['name'];
    $authorsList[] = array('id' => $author_id, 'name' => $author_name);
}

echo json_encode($authorsList);
?>
