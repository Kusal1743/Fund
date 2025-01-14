<?php
include 'config.php';

// Fetch total fundraisers
$stmt = $conn->query("SELECT COUNT(*) AS total_fundraisers FROM fundraisers");
$total_fundraisers = $stmt->fetch(PDO::FETCH_ASSOC)['total_fundraisers'];

// Fetch total donations
$stmt = $conn->query("SELECT SUM(amount) AS total_donations FROM donations");
$total_donations = $stmt->fetch(PDO::FETCH_ASSOC)['total_donations'];

// Fetch active campaigns
$stmt = $conn->query("SELECT COUNT(*) AS active_campaigns FROM fundraisers WHERE status = 'active'");
$active_campaigns = $stmt->fetch(PDO::FETCH_ASSOC)['active_campaigns'];
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main>
    <h2>Dashboard</h2>
    <div class="metrics">
        <div class="metric">
            <h3>Total Fundraisers</h3>
            <p><?php echo $total_fundraisers; ?></p>
        </div>
        <div class="metric">
            <h3>Total Donations</h3>
            <p>$<?php echo number_format($total_donations, 2); ?></p>
        </div>
        <div class="metric">
            <h3>Active Campaigns</h3>
            <p><?php echo $active_campaigns; ?></p>
        </div>
    </div>

    <h2>Users List</h2>
    <div class="users-table">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- User data will be inserted here dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            fetch('fetch_users.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const userTableBody = document.getElementById('userTableBody');
                        data.users.forEach(user => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${user.userid}</td>
                                <td>${user.username}</td>
                                <td>${user.email}</td>
                                <td>
                                    <form action="delete_user.php" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <input type="hidden" name="delete_id" value="${user.userid}">
                                        <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            `;
                            userTableBody.appendChild(row);
                        });
                    } else {
                        console.error('Failed to fetch users:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
    <?php include 'footer.php'; ?>
</main>
