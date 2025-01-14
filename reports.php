<?php

include 'config.php';


// Handle CSV download
if (isset($_GET['download'])) {
    $stmt = $conn->query("SELECT * FROM donations");
    $donations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="donations_report.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Add CSV headers
    fputcsv($output, array('Donation ID', 'Fundraiser ID', 'Donor ID', 'Amount', 'Donation Date', 'Status'));

    // Add data rows
    foreach ($donations as $donation) {
        fputcsv($output, $donation);
    }

    fclose($output);
    exit();
}
?>
<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<main>
    <h2>Reports</h2>
    <p>Generate and download reports for donations and fundraisers.</p>

    <!-- Download Donations Report -->
    <a href="reports.php?download=1" class="btn">Download Donations Report (CSV)</a>
</main>