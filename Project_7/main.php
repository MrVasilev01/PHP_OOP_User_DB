<?php
require_once 'User.php';
require_once 'Database.php';
require_once 'UserManagement.php';

$db = new Database("localhost", "root", "", "init_work");
$userMgmt = new UserManagement($db);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $newUser = new User(null, $username, $email, $role);
        $userMgmt->addUser($newUser);
    } elseif (isset($_POST['update_user'])) {
        $user_id_update = $_POST['user_id_update'];
        $new_email = $_POST['new_email'];

        $retrievedUser = $userMgmt->getUserById($user_id_update);
        if ($retrievedUser) {
            $retrievedUser->setEmail($new_email);
            $userMgmt->updateUser($retrievedUser);
        }
    } elseif (isset($_POST['delete_user'])) {
        $user_id_delete = $_POST['user_id_delete'];
        $userMgmt->deleteUser($user_id_delete);
    }
}

$db->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management System</title>
</head>
<body>
    <h1>User Management System</h1>

    <h2>Add User</h2>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="role">Role:</label>
        <input type="text" id="role" name="role" required><br>

        <input type="submit" name="add_user" value="Add User">
    </form>

    <h2>Update User</h2>
    <form method="post">
        <label for="user_id_update">User ID:</label>
        <input type="number" id="user_id_update" name="user_id_update" required><br>

        <label for="new_email">New Email:</label>
        <input type="email" id="new_email" name="new_email" required><br>

        <input type="submit" name="update_user" value="Update User">
    </form>

    <h2>Delete User</h2>
    <form method="post">
        <label for="user_id_delete">User ID:</label>
        <input type="number" id="user_id_delete" name="user_id_delete" required><br>

        <input type="submit" name="delete_user" value="Delete User">
    </form>
</body>
</html>
