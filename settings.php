<?php
include 'config.php';

// Fetch admin profile
$admin_id = 1; // Replace with the actual admin ID (e.g., from session)
$stmt = $conn->prepare("SELECT * FROM users WHERE userid = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $admin['password'];

    // Update admin profile
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, email = ?, password = ? WHERE userid = ?");
    $stmt->execute([$full_name, $email, $password, $admin_id]);

    echo "<p>Profile updated successfully!</p>";
}
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<main>
    <h2>Settings</h2>
    <form method="POST">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $admin['full_name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $admin['email']; ?>" required>

        <label for="password">New Password:</label>
        <input type="password" name="password">

        <button type="submit">Update Profile</button>
    </form>
    <?php include 'footer.php'; ?>
</main>
