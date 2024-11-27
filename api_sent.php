<?php
// Database connection
include 'dbconnect.php';


// Get action from POST request
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'publishUpdate':
        publishUpdate($conn);
        break;

    case 'sendMessage':
        sendMessage($conn);
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}

// Publish Update
function publishUpdate($conn)
{
    $content = $_POST['content'] ?? '';
    
    if (empty($content)) {
        echo json_encode(['status' => 'error', 'message' => 'Content is required']);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO updates (content) VALUES (?)");
    $stmt->bind_param('s', $content);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Update published successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to publish update']);
    }
    $stmt->close();
}

// Send Message
function sendMessage($conn)
{
    $users = $_POST['users'] ?? [];
    $content = $_POST['content'] ?? '';

    if (empty($users) || empty($content)) {
        echo json_encode(['status' => 'error', 'message' => 'Users and content are required']);
        return;
    }

    $stmt = $conn->prepare("INSERT INTO messages (user_id, content) VALUES (?, ?)");

    foreach ($users as $userId) {
        $stmt->bind_param('is', $userId, $content);
        $stmt->execute();
    }

    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send message']);
    }
    $stmt->close();
}

$conn->close();
?>
