<?php
include("db_connect.php");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="donation_records.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Donor Name', 'Blood Group', 'Recipient Name', 'Hospital', 'Donation Date']);

$sql = "SELECT d.name AS donor_name, d.blood_group, r.name AS recipient_name, r.hospital, rq.donation_date
        FROM requests rq
        JOIN donors d ON rq.donor_id = d.id
        JOIN recipients r ON rq.recipient_id = r.id
        ORDER BY rq.donation_date DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, [
        $row['donor_name'],
        $row['blood_group'],
        $row['recipient_name'],
        $row['hospital'],
        $row['donation_date']
    ]);
}

fclose($output);
exit();
?>
