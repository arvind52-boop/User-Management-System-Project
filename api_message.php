<?php
header('Content-Type: application/json');
session_start();

// Database connection
include 'dbconnect.php';

// Check if the user is logged in
if (!isset($_SESSION['ID'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['ID']; // Use the session user ID

// Action Handling
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'getUserDetails':
        // Fetch user details
        $user_query = $conn->prepare("
            SELECT r.First_Name, r.Last_Name, r.Email, ar.Role 
            FROM register r 
            LEFT JOIN assign_role ar ON r.ID = ar.User_ID 
            WHERE r.ID = ?
        ");
        $user_query->bind_param("i", $user_id);
        $user_query->execute();
        $user_result = $user_query->get_result();
        $user_data = $user_result->fetch_assoc();

        if ($user_data) {
            echo json_encode(['status' => 'success', 'user_details' => $user_data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
        break;

    case 'getMessages':
        // Fetch messages with content and time only
        $message_query = $conn->prepare("
            SELECT m.content, m.sent_at
            FROM messages m
            WHERE m.user_id = ?
            ORDER BY m.sent_at DESC
        ");
        $message_query->bind_param("i", $user_id);
        $message_query->execute();
        $message_result = $message_query->get_result();

        if ($message_result->num_rows > 0) {
            $messages = [];
            while ($row = $message_result->fetch_assoc()) {
                // Only return content and time
                $messages[] = [
                    'content' => $row['content'],
                    'sent_at' => $row['sent_at']
                ];
            }
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } else {
            echo json_encode(['status' => 'success', 'messages' => [], 'message' => 'No messages found']);
        }
        break;

    case 'getUpdates':
        // Fetch updates
        $update_query = "SELECT content, created_at FROM updates ORDER BY created_at DESC";
        $update_result = $conn->query($update_query);
        $updates = [];
        while ($row = $update_result->fetch_assoc()) {
            $updates[] = $row;
        }

        echo json_encode(['status' => 'success', 'updates' => $updates]);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        break;
}

// Close connections
$conn->close();
?>
