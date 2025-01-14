<?php
include 'config.php';

// Fetch all fundraisers
$stmt = $conn->query("SELECT * FROM fundraisers");
$fundraisers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<main>
    <h2>Manage Campaigns</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Goal</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fundraisers as $fundraiser): ?>
            <tr>
                <td><?php echo $fundraiser['fundraiser_id']; ?></td>
                <td><?php echo $fundraiser['title']; ?></td>
                <td>$<?php echo number_format($fundraiser['goal'], 2); ?></td>
                <td><?php echo $fundraiser['status']; ?></td>
                <td>
                    <a href="edit_campaign.php?id=<?php echo $fundraiser['fundraiser_id']; ?>" class="btn-edit">Edit</a>
                    <a href="delete_campaign.php?id=<?php echo $fundraiser['fundraiser_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this campaign?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>