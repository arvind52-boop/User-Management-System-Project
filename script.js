$(document).ready(function () {
    loadUsers();

    function loadUsers() {
        $.post('api_users.php', { action: 'fetch' }, function (response) {
            const users = JSON.parse(response);
            let rows = '';
            users.forEach(user => {
                rows += `
                    <tr>
                        <td><input type="checkbox" class="select-user" data-id="${user.ID}"></td>
                        <td>${user.ID}</td>
                        <td>${user.First_Name}</td>
                        <td>${user.Last_Name}</td>
                        <td>${user.Email}</td>
                        <td>${user.Status}</td>
                        <td>${user.Role || 'Not Assigned'}</td>
                        <td>
                            <button class="btn btn-warning btn-sm update-user" data-id="${user.ID}" data-firstname="${user.First_Name}" data-lastname="${user.Last_Name}" data-email="${user.Email}" data-status="${user.Status}" data-role="${user.Role || ''}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-user" data-id="${user.ID}">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $('#userTable tbody').html(rows);
        });
    }

    // Add user
    $('#addUserBtn').click(function () {
        $('#editUserId').val('');
        $('#editUserModalLabel').text('Add User');
        $('#editUserForm')[0].reset();
        $('#editUserModal').modal('show');
    });

    // Save user (add/update)
    $('#editUserForm').submit(function (event) {
        event.preventDefault();
        const userId = $('#editUserId').val();
        const action = userId ? 'update' : 'addUser';
        const data = {
            action,
            userId,
            firstName: $('#editFirstName').val(),
            lastName: $('#editLastName').val(),
            email: $('#editEmail').val(),
            status: $('#editStatus').val(),
            role: $('#editRole').val(),
        };

        $.post('api_users.php', data, function (response) {
            alert(response);
            $('#editUserModal').modal('hide');
            loadUsers();
        });
    });

    // Edit user
    $(document).on('click', '.update-user', function () {
        const userId = $(this).data('id');
        $('#editUserId').val(userId);
        $('#editUserModalLabel').text('Edit User');
        $('#editFirstName').val($(this).data('firstname'));
        $('#editLastName').val($(this).data('lastname'));
        $('#editEmail').val($(this).data('email'));
        $('#editStatus').val($(this).data('status'));
        $('#editRole').val($(this).data('role'));
        $('#editUserModal').modal('show');
    });

    // Delete single user
    $(document).on('click', '.delete-user', function () {
        const userId = $(this).data('id');
        if (confirm('Are you sure you want to delete this user?')) {
            $.post('api_users.php', { action: 'delete', id: userId }, function (response) {
                alert(response);
                loadUsers();
            });
        }
    });

    // Delete multiple users
    $('#deleteSelectedBtn').click(function () {
        const selectedIds = [];
        $('.select-user:checked').each(function () {
            selectedIds.push($(this).data('id'));
        });

        if (selectedIds.length === 0) {
            alert('No users selected for deletion.');
            return;
        }

        if (confirm('Are you sure you want to delete the selected users?')) {
            $.post('api_users.php', { action: 'deleteMultiple', ids: selectedIds }, function (response) {
                alert(response);
                loadUsers();
            });
        }
    });

    // Search users
    $('#searchInput').on('keyup', function () {
        const query = $(this).val().toLowerCase();
        $('#userTable tbody tr').each(function () {
            const rowText = $(this).text().toLowerCase();
            $(this).toggle(rowText.includes(query));
        });
    });

    // Export to Excel
    $('#exportToExcelBtn').click(function () {
        const tableData = [];
        $('#userTable tr').each(function () {
            const rowData = [];
            $(this).find('td, th').each(function () {
                rowData.push($(this).text());
            });
            tableData.push(rowData);
        });
    
        // Create a worksheet from table data
        const ws = XLSX.utils.aoa_to_sheet(tableData);
    
        // Create a new workbook
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'User Data');
    
        // Export the workbook to Excel file
        XLSX.writeFile(wb, 'user_data.xlsx');
    });
    
   // Open Publish Update Modal


   $('#logoutButton').click(function () {
    $.post('logout.php', function () {
        window.location.href = 'login.php';
    });
});





   // Open Publish Update Modal
$('#sendUpdateBtn').click(function () {
    $('#publishUpdateModal').modal('show');
});

// Handle Publish Update Form Submission
$('#publishUpdateForm').submit(function (e) {
    e.preventDefault();
    const updateContent = $('#updateContent').val();

    // Validate input
    if (!updateContent.trim()) {
        alert('Update content cannot be empty.');
        return;
    }

    // Send AJAX request
    $.post('api_sent.php', { action: 'publishUpdate', content: updateContent }, function (response) {
        const res = JSON.parse(response);
        alert(res.message);

        if (res.status === 'success') {
            $('#publishUpdateModal').modal('hide');
            $('#updateContent').val(''); // Clear input field
        }
    });
});

// Open Send Message Modal
$('#sendMessageBtn').click(function () {
    const selectedUsers = [];
    $('.select-user:checked').each(function () {
        selectedUsers.push($(this).data('id'));
    });

    // Validate user selection
    if (selectedUsers.length === 0) {
        alert('Please select at least one user to send a message.');
        return;
    }

    // Display selected users in the modal
    $('#selectedUserList').html(
        selectedUsers.map(userId => `<li>User ID: ${userId}</li>`).join('')
    );

    $('#sendMessageModal').modal('show');
});

// Handle Send Message Form Submission
$('#sendMessageForm').submit(function (e) {
    e.preventDefault();
    const selectedUsers = [];
    $('.select-user:checked').each(function () {
        selectedUsers.push($(this).data('id'));
    });

    const messageContent = $('#messageContent').val();

    // Validate input
    if (!messageContent.trim()) {
        alert('Message content cannot be empty.');
        return;
    }

    // Send AJAX request
    $.post('api_sent.php', { action: 'sendMessage', users: selectedUsers, content: messageContent }, function (response) {
        const res = JSON.parse(response);
        alert(res.message);

        if (res.status === 'success') {
            $('#sendMessageModal').modal('hide');
            $('#messageContent').val(''); // Clear input field
        }
    });
    
});


});
