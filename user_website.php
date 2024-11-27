<?php
session_start();

if (!isset($_SESSION["ID"])) {
    echo "User not logged in";
    exit;
}
//  else {
//     // User is logged in, proceed with fetching details
//     echo "User logged in as " . $_SESSION["First_Name"] . " " . $_SESSION["Last_Name"];
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1>User Dashboard</h1>
            <button class="btn btn-danger" id="logoutButton">Logout</button>
        </div>

        <!-- User Details Section -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h2>User Details</h2>
            </div>
            <div class="card-body" id="userDetailsSection">
                <p><strong>Name:</strong> <span id="userName">Loading...</span></p>
                <p><strong>Email:</strong> <span id="userEmail">Loading...</span></p>
                <p><strong>Role:</strong> <span id="userRole">Loading...</span></p>
            </div>
        </div>

        <!-- Publish Updates Section -->
        <div class="card mt-4">
            <div class="card-header bg-warning text-dark">
                <h2>Published Updates</h2>
            </div>
            <div class="card-body" id="updatesSection">
                <p>Loading updates...</p>
            </div>
        </div>

        <!-- Messages Section -->
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h2>Your Messages</h2>
            </div>
            <div class="card-body" id="messagesSection">
                <p>Loading messages...</p>
            </div>
        </div>
    </div>

    <script>
        const userId = <?php echo $_SESSION['ID']; ?>; // Dynamically using PHP session variable

        // Fetch User Details
        function fetchUserDetails() {
            $.get('api_message.php', { action: 'getUserDetails', user_id: userId }, function (response) {
                if (response.status === 'success') {
                    const user = response.user_details;
                    $('#userName').text(user.First_Name + ' ' + user.Last_Name);
                    $('#userEmail').text(user.Email);
                    $('#userRole').text(user.Role);
                } else {
                    $('#userDetailsSection').html(`<p>${response.message}</p>`);
                }
            }).fail(function () {
                $('#userDetailsSection').html('<p>Error loading user details.</p>');
            });
        }

        // Fetch Updates
        function fetchUpdates() {
            $.get('api_message.php', { action: 'getUpdates' }, function (response) {
                if (response.status === 'success') {
                    const updates = response.updates;
                    const updatesHtml = updates.map(update => ` 
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5>${update.content}</h5>
                                <small>Published on: ${update.created_at}</small>
                            </div>
                        </div>
                    `).join('');
                    $('#updatesSection').html(updatesHtml);
                } else {
                    $('#updatesSection').html('<p>No updates available.</p>');
                }
            }).fail(function () {
                $('#updatesSection').html('<p>Error loading updates.</p>');
            });
        }

        // Fetch Messages
        function fetchMessages() {
            $.get('api_message.php', { action: 'getMessages', user_id: userId }, function (response) {
    if (response.status === 'success') {
        if (response.messages.length === 0) {
            $('#messagesSection').html('<p>No messages available.</p>');
        } else {
            const messagesHtml = response.messages.map(msg => `
                <div class="card mb-2">
                    <div class="card-body">
                        <p>${msg.content}</p>
                        <small>Sent by: ${msg.sender_name || 'Admin'} on ${msg.sent_at}</small>
                    </div>
                </div>
            `).join('');
            $('#messagesSection').html(messagesHtml);
        }
    } else {
        $('#messagesSection').html('<p>Error fetching messages.</p>');
    }
}).fail(function () {
    $('#messagesSection').html('<p>Error fetching messages.</p>');
});
}

        // Logout Handler
        $('#logoutButton').click(function () {
            $.post('logout.php', function () {
                window.location.href = 'login.php';
            });
        });

        // Initial Load
        $(document).ready(function () {
            fetchUserDetails();
            fetchUpdates();
            fetchMessages();
        });
    </script>
</body>
</html>
