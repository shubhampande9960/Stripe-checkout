<?php

require_once('vendor/init.php'); // Include the Stripe PHP library

session_start();

\Stripe\Stripe::setApiKey('sk_test_51N2pyOSBHDHaVYHamjX8HRqzyeHd0Poht6YphWFEME1GY3kf8EtQ0aI6V75vZiMTyFUu4ewaDmPcbukhZEs1eSxn003lQp2TzL'); // Set your Stripe API key

// Generate a new CSRF token and store it in the session
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Create a new checkout session with Stripe
$session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price' => 'price_1N2rHpSBHDHaVYHaHYdSBOJV',
    'quantity' => 1,
    ]],
  'mode' => 'subscription',
  'success_url' => 'http://localhost/success?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => 'http://localhost/stripe-checkout/cancel',
]);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Stripe Checkout</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1>Stripe Checkout</h1>
	<form action="<?php echo $session->url; ?>" method="POST">
		<script src="https://js.stripe.com/v3/"></script>
		<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
		<button type="submit">Checkout</button>
	</form>
</body>
</html>
