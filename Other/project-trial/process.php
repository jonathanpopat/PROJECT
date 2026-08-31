<?php
/**
 * Ashworth & Vane — Application Processor
 * Validates the submitted form. On failure, bounces back to apply.php with
 * the error and prior input preserved in the query string. On success,
 * shows a confirmation receipt with a generated reference number.
 */

function h($value) {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$loanLabels = [
  'home'     => 'Home Loan',
  'gold'     => 'Gold Loan',
  'car'      => 'Car Loan',
  'personal' => 'Personal Loan',
];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: apply.php');
  exit;
}

// Collect and lightly sanitise input.
$loanType   = strtolower(trim($_POST['loan_type']   ?? ''));
$fullName   = trim($_POST['full_name']   ?? '');
$email      = trim($_POST['email']       ?? '');
$phone      = trim($_POST['phone']       ?? '');
$income     = trim($_POST['income']      ?? '');
$loanAmount = trim($_POST['loan_amount'] ?? '');
$notes      = trim($_POST['notes']       ?? '');

$errors = [];

if (!array_key_exists($loanType, $loanLabels))            { $errors[] = 'Please select a valid loan type.'; }
if ($fullName === '' || strlen($fullName) < 2)             { $errors[] = 'Please enter your full name.'; }
if (!filter_var($email, FILTER_VALIDATE_EMAIL))             { $errors[] = 'Please enter a valid email address.'; }
if ($phone === '' || !preg_match('/^[0-9+()\s-]{7,20}$/', $phone)) { $errors[] = 'Please enter a valid phone number.'; }
if (!is_numeric($income) || (float)$income <= 0)            { $errors[] = 'Please enter a valid monthly income.'; }
if (!is_numeric($loanAmount) || (float)$loanAmount < 500)    { $errors[] = 'Loan amount must be at least £500.'; }

if (!empty($errors)) {
  $query = http_build_query([
    'type'        => $loanType ?: 'home',
    'error'       => implode(' ', $errors),
    'full_name'   => $fullName,
    'email'       => $email,
    'phone'       => $phone,
    'loan_amount' => $loanAmount,
    'income'      => $income,
    'notes'       => $notes,
  ]);
  header('Location: apply.php?' . $query);
  exit;
}

// --- Application accepted -------------------------------------------------

// Generate a human-friendly reference number, e.g. AV-2026-7X4K9.
$refNumber = sprintf(
  'AV-%s-%s',
  date('Y'),
  strtoupper(substr(bin2hex(random_bytes(3)), 0, 5))
);

// In a production system this is where the application would be written to
// a database and the relationship manager notified, e.g.:
//
//   $stmt = $pdo->prepare('INSERT INTO applications (...) VALUES (...)');
//   $stmt->execute([...]);
//   mail('team@ashworthvane.co.uk', 'New application ' . $refNumber, ...);

$submittedAt = date('d F Y, H:i');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Application Received — Ashworth & Vane</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
  <nav class="nav">
    <a href="index.html" class="brand-mark">Ashworth <span>&</span> Vane</a>
    <ul class="nav-links">
      <li><a href="index.html#loans">Loans</a></li>
      <li><a href="index.html#rates">Rates</a></li>
      <li><a href="index.html#process">Process</a></li>
      <li><a href="index.html#footer">Contact</a></li>
    </ul>
    <a href="index.html" class="btn btn--ghost">Back to Home</a>
  </nav>
</header>

<section class="page-head">
  <div class="wrap">
    <p class="eyebrow">Thank You</p>
    <h1>Application Received, <?php echo h(explode(' ', $fullName)[0]); ?></h1>
    <p>A relationship manager will contact you within one business day to confirm the next steps.</p>
  </div>
</section>

<section class="section--tight">
  <div class="wrap">
    <div class="receipt">
      <div class="receipt-head">
        <svg class="check" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="12" cy="12" r="9.5"/><path d="M8 12.3l2.6 2.6L16.3 9"/></svg>
        <h3>Your Application Summary</h3>
      </div>

      <div class="receipt-row"><span class="k">Loan Type</span><span class="v"><?php echo h($loanLabels[$loanType]); ?></span></div>
      <div class="receipt-row"><span class="k">Applicant</span><span class="v"><?php echo h($fullName); ?></span></div>
      <div class="receipt-row"><span class="k">Email</span><span class="v"><?php echo h($email); ?></span></div>
      <div class="receipt-row"><span class="k">Phone</span><span class="v"><?php echo h($phone); ?></span></div>
      <div class="receipt-row"><span class="k">Monthly Income</span><span class="v">£<?php echo h(number_format((float)$income, 0)); ?></span></div>
      <div class="receipt-row"><span class="k">Amount Requested</span><span class="v">£<?php echo h(number_format((float)$loanAmount, 0)); ?></span></div>
      <div class="receipt-row"><span class="k">Submitted</span><span class="v"><?php echo h($submittedAt); ?></span></div>
      <?php if ($notes !== ''): ?>
      <div class="receipt-row"><span class="k">Notes</span><span class="v" style="font-family:var(--body); font-weight:400; text-align:right; max-width:60%;"><?php echo h($notes); ?></span></div>
      <?php endif; ?>

      <p class="ref-number">Reference Number: <?php echo h($refNumber); ?></p>
    </div>

    <div style="text-align:center; margin-top:44px;">
      <a href="index.html" class="btn btn--ghost">Return to Home</a>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="wrap">
    <div class="footer-bottom">
      <span>&copy; 2026 Ashworth &amp; Vane Private Lending House. All rights reserved.</span>
      <span>Please retain your reference number for correspondence.</span>
    </div>
  </div>
</footer>

</body>
</html>
