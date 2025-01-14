<?php
include 'config.php'; // Include the database connection file

// Check if the fundraiser ID is provided in the URL
if (isset($_GET['id'])) {
    $fundraiser_id = $_GET['id'];

    try {
        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM fundraisers WHERE fundraiser_id = ?");
        $stmt->execute([$fundraiser_id]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            // Redirect to the manage campaigns page with a success message
            header("Location: manage_campaigns.php?message=Campaign deleted successfully!");
            exit();
        } else {
            // Redirect with an error message if no rows were affected
            header("Location: manage_campaigns.php?error=Campaign not found or already deleted.");
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        header("Location: manage_campaigns.php?error=Database error: " . $e->getMessage());
        exit();
    }
} else {
    // Redirect if no ID is provided
    header("Location: manage_campaigns.php?error=Invalid request.");
    exit();
}
?>