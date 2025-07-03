<?php
require_once('vendor/autoload.php'); // Correct autoload for Stripe PHP SDK

session_start();

\Stripe\Stripe::setApiKey('sk_test_51N2pyOSBHDHaVYHamjX8HRqzyeHd0Poht6YphWFEME1GY3kf8EtQ0aI6V75vZiMTyFUu4ewaDmPcbukhZEs1eSxn003lQp2TzL');

// Create a new CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Create Checkout session
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
</head>
<body>
    <h1>Subscribe via Stripe</h1>

    <input type="hidden" id="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <button id="checkout-button">Checkout</button>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('pk_test_51N2pyOSBHDHaVYHaR9DOwj17yV2BfqO2qu4SKb3m9DP2pMXBtjpUZ8Mb9wMFWns18Yg0XuwPjDsAiX01AypemSQk00qsGfzbJp'); // Replace with your actual publishable key

        document.getElementById("checkout-button").addEventListener("click", function () {
            stripe.redirectToCheckout({
                sessionId: "<?php echo $session->id; ?>"
            }).then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            });
        });
    </script>
</body>
</html>
