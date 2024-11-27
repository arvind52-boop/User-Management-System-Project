<?php
include 'dbconnect.php';

$action = $_POST['action'];

if ($action === 'fetch') {
    $result = mysqli_query($conn, "SELECT * FROM permissions");
    $permissions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($permissions);
} elseif ($action === 'add') {
    $permissionName = $_POST['permissionName'];
    mysqli_query($conn, "INSERT INTO permissions (Permission_Name) VALUES ('$permissionName')");
    echo "Permission added successfully!";
}
?>
