<?php
/**
 * Ashworth & Vane — Apply for a Loan
 * Pre-fills the loan type from a query string (?type=home|gold|car|personal)
 * and shows a matching indicative rate in the sidebar.
 */

$loanData = [
  'home'     => ['label' => 'Home Loan',     'rate' => '8.25%', 'tenure' => '25 years', 'max' => '£1.5M'],
  'gold'     => ['label' => 'Gold Loan',     'rate' => '9.00%', 'tenure' => '3 years',  'max' => '£150K'],
  'car'      => ['label' => 'Car Loan',      'rate' => '8.75%', 'tenure' => '7 years',  'max' => '£120K'],
  'personal' => ['label' => 'Personal Loan', 'rate' => '10.50%','tenure' => '5 years',  'max' => '£75K'],
];

$requestedType = isset($_GET['type']) ? strtolower(trim($_GET['type'])) : '';
$selectedType  = array_key_exists($requestedType, $loanData) ? $requestedType : 'home';
$selected      = $loanData[$selectedType];

// If we were bounced back from process.php with an error, recover the message and prior input.
$errorMessage = isset($_GET['error']) ? $_GET['error'] : '';
$old = [
  'full_name'    => $_GET['full_name']    ?? '',
  'email'        => $_GET['email']        ?? '',
  'phone'        => $_GET['phone']        ?? '',
  'loan_amount'  => $_GET['loan_amount']  ?? '',
  'income'       => $_GET['income']       ?? '',
  'notes'        => $_GET['notes']        ?? '',
];

function h($value) {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Apply for a Loan — Ashworth & Vane</title>
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
    <p class="eyebrow">Application</p>
    <h1>Apply for a <?php echo h($selected['label']); ?></h1>
    <p>A relationship manager will review your details personally and respond within one business day.</p>
  </div>
</section>

<section class="section--tight">
  <div class="wrap apply-layout">

    <div>
      <?php if ($errorMessage): ?>
        <div class="error-banner">
          <?php echo h($errorMessage); ?>
        </div>
      <?php endif; ?>

      <div class="form-card">
        <form action="process.php" method="POST">
          <div class="form-grid">

            <div class="field full">
              <label for="loan_type">Loan Type</label>
              <select id="loan_type" name="loan_type" required>
                <?php foreach ($loanData as $key => $data): ?>
                  <option value="<?php echo h($key); ?>" <?php echo $key === $selectedType ? 'selected' : ''; ?>>
                    <?php echo h($data['label']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="field">
              <label for="full_name">Full Name</label>
              <input type="text" id="full_name" name="full_name" placeholder="Jane Whitfield" value="<?php echo h($old['full_name']); ?>" required>
            </div>

            <div class="field">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="jane@email.com" value="<?php echo h($old['email']); ?>" required>
            </div>

            <div class="field">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" placeholder="+44 7000 000000" value="<?php echo h($old['phone']); ?>" required>
            </div>

            <div class="field">
              <label for="income">Monthly Income (£)</label>
              <input type="number" id="income" name="income" placeholder="4500" min="0" value="<?php echo h($old['income']); ?>" required>
            </div>

            <div class="field full">
              <label for="loan_amount">Loan Amount Required (£)</label>
              <input type="number" id="loan_amount" name="loan_amount" placeholder="25000" min="500" value="<?php echo h($old['loan_amount']); ?>" required>
            </div>

            <div class="field full">
              <label for="notes">Anything We Should Know</label>
              <textarea id="notes" name="notes" placeholder="Purpose of the loan, preferred tenure, or timing considerations."><?php echo h($old['notes']); ?></textarea>
            </div>

          </div>

          <p class="form-note">By submitting, you agree to be contacted regarding this application. We do not share your details with third parties.</p>

          <div style="margin-top:26px;">
            <button type="submit" class="btn btn--primary">Submit Application</button>
          </div>
        </form>
      </div>
    </div>

    <aside>
      <div class="side-card">
        <h3>Why Apply With Us</h3>
        <ul>
          <li>Decisions in 24 hours, not weeks</li>
          <li>One relationship manager, start to finish</li>
          <li>No hidden fees in the small print</li>
          <li>Complete confidentiality, always</li>
        </ul>
      </div>

      <div class="side-rate">
        <div class="label">Indicative Rate — <?php echo h($selected['label']); ?></div>
        <div class="value"><?php echo h($selected['rate']); ?> p.a.</div>
        <div class="rule" style="margin:16px 0;"></div>
        <div class="receipt-row" style="border:none; padding:6px 0;">
          <span class="k">Max Tenure</span><span class="v" style="font-size:14px;"><?php echo h($selected['tenure']); ?></span>
        </div>
        <div class="receipt-row" style="border:none; padding:6px 0;">
          <span class="k">Max Amount</span><span class="v" style="font-size:14px;"><?php echo h($selected['max']); ?></span>
        </div>
      </div>
    </aside>

  </div>
</section>

<footer class="site-footer">
  <div class="wrap">
    <div class="footer-bottom">
      <span>&copy; 2026 Ashworth &amp; Vane Private Lending House. All rights reserved.</span>
      <span>Representative example. Rates subject to status.</span>
    </div>
  </div>
</footer>

</body>
</html>
