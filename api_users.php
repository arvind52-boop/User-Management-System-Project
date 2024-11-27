<?php
include 'dbconnect.php';

$action = $_POST['action'];

if ($action === 'fetch') {
    $result = $conn->query("SELECT register.*, assign_role.Role FROM register LEFT JOIN assign_role ON register.ID = assign_role.User_ID");
    $users = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($users);
} elseif ($action === 'delete') {
    $userId = intval($_POST['id']);
    
    // Delete related records in assign_role table first
    $conn->query("DELETE FROM assign_role WHERE User_ID = $userId");
    
    // Now delete the user from the register table
    $conn->query("DELETE FROM register WHERE ID = $userId");
    
    echo "User deleted successfully!";
} elseif ($action === 'update') {
    $userId = intval($_POST['userId']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $status = $conn->real_escape_string($_POST['status']);
    $role = $conn->real_escape_string($_POST['role']);

    $conn->query("UPDATE register SET First_Name = '$firstName', Last_Name = '$lastName', Email = '$email', Status = '$status' WHERE ID = $userId");

    $result = $conn->query("SELECT * FROM assign_role WHERE User_ID = $userId");
    if ($result->num_rows > 0) {
        $conn->query("UPDATE assign_role SET Role = '$role' WHERE User_ID = $userId");
    } else {
        $conn->query("INSERT INTO assign_role (User_ID, Role) VALUES ($userId, '$role')");
    }

    echo "User updated successfully!";
} elseif ($action === 'addUser') {
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $status = $conn->real_escape_string($_POST['status']);
    $role = $conn->real_escape_string($_POST['role']);

    $conn->query("INSERT INTO register (First_Name, Last_Name, Email, Status) VALUES ('$firstName', '$lastName', '$email', '$status')");
    $userId = $conn->insert_id;

    if ($role) {
        $conn->query("INSERT INTO assign_role (User_ID, Role) VALUES ($userId, '$role')");
    }

    echo "User added successfully!";
}

$conn->close();
?>
