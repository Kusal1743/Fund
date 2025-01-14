<?php
include 'config.php';

// Fetch data for donations over time
$stmt = $conn->query("SELECT DATE(donation_date) AS date, SUM(amount) AS total FROM donations GROUP BY DATE(donation_date)");
$donations_over_time = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch data for fundraiser goals vs. amounts raised
$stmt = $conn->query("SELECT title, goal, current_amount FROM fundraisers");
$fundraiser_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch data for country-wise donation amounts
$stmt = $conn->query("SELECT u.country, SUM(d.amount) AS total FROM donations d JOIN users u ON d.donor_id = u.userid GROUP BY u.country");
$country_donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main>
    <h2>Analytics</h2>

    <?php
include 'config.php'; // Include the database connection file

// Fetch data for fundraiser goals vs. amounts raised
$stmt = $conn->query("SELECT title, goal, current_amount FROM fundraisers");
$fundraiser_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundraiser Analysis</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            max-width: 800px;
            margin: 20px auto;
            display: block;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar.php'; ?>

    <main>
        <h2>Fundraiser Goals vs. Amounts Raised</h2>
        <canvas id="fundraiserChart" width="800" height="400"></canvas>
    </main>

    <script>
        // Data for the bar chart
        const fundraiserData = {
            labels: <?php echo json_encode(array_column($fundraiser_data, 'title')); ?>,
            datasets: [{
                label: 'Goal',
                data: <?php echo json_encode(array_column($fundraiser_data, 'goal')); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Amount Raised',
                data: <?php echo json_encode(array_column($fundraiser_data, 'current_amount')); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        // Render the bar chart
        const ctx = document.getElementById('fundraiserChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: fundraiserData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount ($)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Fundraiser Title'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Fundraiser Goals vs. Amounts Raised'
                    }
                }
            }
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>

