<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $user_id = $_POST['delete_id'];

    try {
        $stmt = $conn->prepare("DELETE FROM users WHERE userid = ?");
        $stmt->execute([$user_id]);

        if ($stmt->rowCount() > 0) {
            echo "User deleted successfully!";
        } else {
            echo "Failed to delete user.";
        }
        
        // Redirect to index.php after deletion
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}