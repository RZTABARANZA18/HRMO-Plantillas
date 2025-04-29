<?php
require_once 'config.php';

// Remove JSON header
// header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method not allowed";
    exit;
}

// Function to clean and split textarea content
function getCleanValues($text) {
    return array_filter(
        array_map(
            function($line) {
                return trim(preg_replace('/^\d+\.\s*/', '', $line));
            },
            explode("\n", $text)
        ),
        function($line) {
            return !empty($line);
        }
    );
}

// Function to validate and format date
function validateDate($dateStr) {
    if (empty($dateStr)) return null;
    
    // Clean the date string
    $dateStr = trim($dateStr);
    
    // Check if date is already in YYYY-MM-DD format
    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateStr)) {
        return $dateStr;
    }
    
    // Try to parse the date
    $date = date_create($dateStr);
    if (!$date) return null;
    
    return date_format($date, 'Y-m-d');
}

// Get and clean form data
$names = getCleanValues($_POST['name']);
$designations = getCleanValues($_POST['designation']);
$rates = getCleanValues($_POST['rate']);
$datesFrom = getCleanValues($_POST['dateFrom']);
$datesTo = getCleanValues($_POST['dateTo']);
$fundings = getCleanValues($_POST['funding']);
$offices = getCleanValues($_POST['office']);
$acknowledgements = getCleanValues($_POST['acknowledgement']);

// Get the maximum length of all arrays
$maxLength = max(
    count($names),
    count($designations),
    count($rates),
    count($datesFrom),
    count($datesTo),
    count($fundings),
    count($offices),
    count($acknowledgements)
);

$successCount = 0;
$errorCount = 0;

// Prepare the insert statement
$stmt = $conn->prepare("
    INSERT INTO job_orders 
    (name, designation, rate_per_day, date_from, date_to, funding_charges, office_assignment, acknowledgement)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

// Process each entry
for ($i = 0; $i < $maxLength; $i++) {
    $name = $names[$i] ?? '';
    $designation = $designations[$i] ?? '';
    $rate = floatval($rates[$i] ?? 0);
    $dateFrom = validateDate($datesFrom[$i] ?? '');
    $dateTo = validateDate($datesTo[$i] ?? '');
    $funding = $fundings[$i] ?? '';
    $office = $offices[$i] ?? '';
    $acknowledgement = $acknowledgements[$i] ?? '';

    // Skip if required fields are empty
    if (empty($name) || empty($designation) || empty($dateFrom) || empty($dateTo)) {
        $errorCount++;
        continue;
    }

    $stmt->bind_param(
        "ssdsssss",
        $name,
        $designation,
        $rate,
        $dateFrom,
        $dateTo,
        $funding,
        $office,
        $acknowledgement
    );

    if ($stmt->execute()) {
        $successCount++;
    } else {
        $errorCount++;
    }
}

$stmt->close();

if ($errorCount === 0) {
    header('Location: index.php?status=success&count=' . $successCount);
} else {
    header('Location: index.php?status=error&success=' . $successCount . '&error=' . $errorCount);
}
exit; 