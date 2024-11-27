<?php
include 'dbconnect.php';

$action = $_POST['action'];

if ($action === 'fetch') {
    $result = mysqli_query($conn, "SELECT * FROM register_roles");
    $roles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($roles);
} elseif ($action === 'add') {
    $roleName = $_POST['roleName'];
    mysqli_query($conn, "INSERT INTO register_roles (Role_Name) VALUES ('$roleName')");
    echo "Role added successfully!";
} elseif ($action === 'delete') {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM register_roles WHERE ID=$id");
    echo "Role deleted successfully!";
}
?>
