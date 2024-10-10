<?php
require '../vendor/autoload.php'; // Include the Composer autoload file

use Dompdf\Dompdf;

// Initialize Dompdf
$dompdf = new Dompdf();

if (isset($_GET['user_id']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
    include 'db_connection.php'; // Include your database connection

    $user_id = $_GET['user_id'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // Fetch reports from the database
    $query = "SELECT * FROM employee_reports WHERE user_id = ? AND report_date BETWEEN ? AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $start_date, $end_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Prepare HTML for PDF
    $html = '<h1>Employee Reports</h1>';
    $html .= '<table border="1" cellpadding="10" cellspacing="0">';
    $html .= '<thead><tr><th>ID</th><th>User ID</th><th>Report Date</th><th>Work Description</th><th>Submission Time</th></tr></thead>';
    $html .= '<tbody>';

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['id'] . '</td>';
        $html .= '<td>' . $row['user_id'] . '</td>';
        $html .= '<td>' . $row['report_date'] . '</td>';
        $html .= '<td>' . $row['work_description'] . '</td>';
        $html .= '<td>' . $row['submission_time'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    // Load HTML content to Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to the browser
    $dompdf->stream("employee_reports.pdf", array("Attachment" => false)); // Change to true to force download
} else {
    echo 'Invalid parameters!';
}
?>
