<?php
require_once 'connect.php';

$query = "SELECT id, name FROM location";
$result = mysqli_query($conn, $query);

$locationsList = array();
while ($row = mysqli_fetch_assoc($result)) {
    $location_id = $row['id'];
    $location_name = $row['name'];
    $locationsList[] = array('id' => $location_id, 'name' => $location_name);
}
?>

<option value="" disabled selected>Wybierz lokalizację...</option>
<?php foreach ($locationsList as $location) { ?>
    <option value="<?php echo $location['id']; ?>"><?php echo $location['name']; ?></option>
<?php } ?>
