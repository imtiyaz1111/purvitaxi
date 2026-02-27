<?php
// ================= SECURITY CHECK =================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.html");
    exit();
}

// ================= SANITIZE INPUT =================
$name          = htmlspecialchars(trim($_POST['name'] ?? ''), ENT_QUOTES, 'UTF-8');
$phone         = htmlspecialchars(trim($_POST['phone'] ?? ''), ENT_QUOTES, 'UTF-8');
$pickup        = htmlspecialchars(trim($_POST['pickup'] ?? ''), ENT_QUOTES, 'UTF-8');
$drop_location = htmlspecialchars(trim($_POST['drop_location'] ?? ''), ENT_QUOTES, 'UTF-8');
$source_page   = htmlspecialchars(trim($_POST['source_page'] ?? 'Website'), ENT_QUOTES, 'UTF-8');

// ================= VALIDATION =================
if ($name === '' || $phone === '' || $pickup === '' || $drop_location === '') {
    echo "Required fields missing.";
    exit();
}

// Indian 10-digit phone validation
if (!preg_match('/^[6-9]\d{9}$/', $phone)) {
    echo "Invalid phone number.";
    exit();
}

// ================= EMAIL SETTINGS =================
$to = "sharmamithun48010@gmail.com";
$subject = "🚖 New Taxi Inquiry – Purvi Taxi Service";

// IMPORTANT: Replace with your real domain email
$fromEmail = "no-reply@purvitaxiservice.com";
$fromName  = "Purvi Taxi Service";

// ================= EMAIL BODY =================
$message = "
<html>
<head>
  <style>
    body { font-family: Arial, sans-serif; }
    table { border-collapse: collapse; width: 100%; }
    td { padding: 10px; border: 1px solid #ddd; }
    h2 { color: #0d6efd; }
  </style>
</head>
<body>

<h2>🚖 New Booking Inquiry Received</h2>

<table>
  <tr>
    <td><strong>Name</strong></td>
    <td>{$name}</td>
  </tr>
  <tr>
    <td><strong>Phone</strong></td>
    <td>{$phone}</td>
  </tr>
  <tr>
    <td><strong>Pickup Location</strong></td>
    <td>{$pickup}</td>
  </tr>
  <tr>
    <td><strong>Drop Location</strong></td>
    <td>{$drop_location}</td>
  </tr>
  <tr>
    <td><strong>Source Page</strong></td>
    <td>{$source_page}</td>
  </tr>
</table>

<br>
<p>
<strong>Website:</strong> Purvi Taxi Service<br>
<strong>Location:</strong> Mathura, Uttar Pradesh
</p>

</body>
</html>
";

// ================= HEADERS =================
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: {$fromName} <{$fromEmail}>\r\n";
$headers .= "Reply-To: {$phone}\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// ================= SEND MAIL =================
if (mail($to, $subject, $message, $headers)) {
    header("Location: ../../thankyou.html");
    exit();
} else {
    echo "<h3>Mail sending failed. Please contact administrator.</h3>";
}
?>