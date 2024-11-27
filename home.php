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
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<link rel="stylesheet" href="style.css">

<body>
    <header class="bg-primary text-white p-3">
        
        <div class="d-flex justify-content-between align-items-center">
            <h1>User Management System</h1>
            <button class="btn btn-danger" id="logoutButton">Logout</button>
        </div>
    </header>

    <div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search Users">
        <button class="btn btn-success" id="addUserBtn">Add User</button>
        <button class="btn btn-danger" id="deleteSelectedBtn">Delete Selected</button>
        <button class="btn btn-info" id="exportToExcelBtn">Export to Excel</button>
        <button class="btn btn-primary" id="sendUpdateBtn">Publish Update</button>
        <button class="btn btn-secondary" id="sendMessageBtn">Send Message</button>
    </div>
</div>
        
        <table class="table table-bordered" id="userTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- User rows will be populated here -->
            </tbody>
        </table>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 User Management System</p>
    </footer>

    <!-- Edit User Modal -->
    <div id="editUserModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editUserForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editUserId">
                        <div class="form-group">
                            <label for="editFirstName">First Name</label>
                            <input type="text" id="editFirstName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editLastName">Last Name</label>
                            <input type="text" id="editLastName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editStatus">Status</label>
                            <select id="editStatus" class="form-control" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editRole">Role</label>
                            <select id="editRole" class="form-control" required>
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Viewer">Viewer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Publish Update Modal -->
    <div id="publishUpdateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="publishUpdateForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Publish Update</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea id="updateContent" class="form-control" placeholder="Enter update content here..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Publish</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Send Message Modal -->
    <div id="sendMessageModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="sendMessageForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Message</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Selected Users:</label>
                            <ul id="selectedUserList"></ul>
                        </div>
                        <div class="form-group">
                            <textarea id="messageContent" class="form-control" placeholder="Enter message here..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
</body>
</html>
