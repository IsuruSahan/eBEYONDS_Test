<?php
// CONFIG
$adminEmails = [
    'dumidu.kodithuwakku@ebeyonds.com',
    'prabhath.senadheera@ebeyonds.com'
];
$dataFile = 'data/submissions.json';

// GET FORM DATA
$firstName = trim($_POST['first_name'] ?? '');
$lastName  = trim($_POST['last_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$comments  = trim($_POST['comments'] ?? '');

// VALIDATE
$errors = [];

if (!$firstName) $errors[] = 'First name is required.';
if (!$lastName)  $errors[] = 'Last name is required.';
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if (!$comments)  $errors[] = 'Comments are required.';

if (!empty($errors)) {
    echo "Error:<br>" . implode("<br>", $errors);
    exit;
}

// SAVE TO JSON
$submission = [
    'first_name' => $firstName,
    'last_name'  => $lastName,
    'email'      => $email,
    'phone'      => $phone,
    'comments'   => $comments,
    'submitted_at' => date('Y-m-d H:i:s')
];

$existing = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
$existing[] = $submission;
file_put_contents($dataFile, json_encode($existing, JSON_PRETTY_PRINT));

// AUTO-REPLY EMAIL
$subjectUser = "Thank you for contacting Movie Library!";
$messageUser = "Hi $firstName,\n\nThank you for contacting us. We'll get back to you shortly.\n\n-- Movie Library Team";
$headersUser = "From: noreply@yourdomain.com";

mail($email, $subjectUser, $messageUser, $headersUser);

// ADMIN EMAIL
$subjectAdmin = "New Contact Form Submission";
$messageAdmin = "A new message has been submitted:\n\n" .
    "Name: $firstName $lastName\n" .
    "Email: $email\n" .
    "Phone: $phone\n" .
    "Comments:\n$comments\n\n" .
    "Submitted At: " . date('Y-m-d H:i:s');

foreach ($adminEmails as $adminEmail) {
    mail($adminEmail, $subjectAdmin, $messageAdmin, "From: contact@yourdomain.com");
}

// REDIRECT OR THANK YOU
echo "<h2>Thank you! Your message has been sent.</h2>";
