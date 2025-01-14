<?php
include 'config.php'; // Include the database connection file

// Check if the fundraiser ID is provided in the URL
if (isset($_GET['id'])) {
    $fundraiser_id = $_GET['id'];

    // Fetch the fundraiser details from the database
    $stmt = $conn->prepare("SELECT * FROM fundraisers WHERE fundraiser_id = ?");
    $stmt->execute([$fundraiser_id]);
    $fundraiser = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$fundraiser) {
        // Redirect if the fundraiser is not found
        header("Location: manage_campaigns.php?error=Campaign not found.");
        exit();
    }
} else {
    // Redirect if no ID is provided
    header("Location: manage_campaigns.php?error=Invalid request.");
    exit();
}

// Handle form submission for updating the fundraiser
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $goal = $_POST['goal'];
    $location = $_POST['location'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];

    try {
        // Prepare and execute the update query
        $stmt = $conn->prepare("UPDATE fundraisers SET title = ?, description = ?, goal = ?, location = ?, start_date = ?, end_date = ?, status = ? WHERE fundraiser_id = ?");
        $stmt->execute([$title, $description, $goal, $location, $start_date, $end_date, $status, $fundraiser_id]);

        // Redirect to the manage campaigns page with a success message
        header("Location: manage_campaigns.php?message=Campaign updated successfully!");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        header("Location: manage_campaigns.php?error=Database error: " . $e->getMessage());
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Campaign</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <main>
        <h2>Edit Campaign</h2>
        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $fundraiser['title']; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $fundraiser['description']; ?></textarea>

            <label for="goal">Goal:</label>
            <input type="number" id="goal" name="goal" step="0.01" value="<?php echo $fundraiser['goal']; ?>" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="<?php echo $fundraiser['location']; ?>" required>

            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $fundraiser['start_date']; ?>" required>

            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $fundraiser['end_date']; ?>" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="active" <?php echo $fundraiser['status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                <option value="completed" <?php echo $fundraiser['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?php echo $fundraiser['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>

            <button type="submit">Update Campaign</button>
        </form>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>