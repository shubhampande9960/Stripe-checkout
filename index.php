<?php
require_once('vendor/autoload.php'); // Composer autoloader

session_start();

// Set Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51N2pyOSBHDHaVYHamjX8HRqzyeHd0Poht6YphWFEME1GY3kf8EtQ0aI6V75vZiMTyFUu4ewaDmPcbukhZEs1eSxn003lQp2TzL'); // Replace with your test secret key

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Create Checkout Session
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price' => 'price_1N2rHpSBHDHaVYHaHYdSBOJV', // Replace with your price ID
        'quantity' => 1,
    ]],
    'mode' => 'subscription',
    'success_url' => 'http://localhost/Stripe-Checkout-Project/success.php?session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost/Stripe-Checkout-Project/',
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        .btn {
            background: #635bff;
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn:hover {
            background: #5245e0;
        }

        .logo {
            width: 64px;
            margin-bottom: 16px;
        }

        h2 {
            margin: 0 0 10px;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="https://stripe.com/img/v3/home/twitter.png" class="logo" alt="Logo" />
    <h2>Sample Checkout</h2>
    <button class="btn" id="checkout-button">Checkout</button>
</div>

<script>
    const stripe = Stripe('pk_test_51N2pyOSBHDHaVYHaR9DOwj17yV2BfqO2qu4SKb3m9DP2pMXBtjpUZ8Mb9wMFWns18Yg0XuwPjDsAiX01AypemSQk00qsGfzbJp'); // Replace with your test publishable key

    document.getElementById("checkout-button").addEventListener("click", function () {
        const button = this;
        button.disabled = true;
        button.innerText = "Redirecting...";

        stripe.redirectToCheckout({
            sessionId: "<?php echo $session->id; ?>"
        }).then(function (result) {
            if (result.error) {
                alert(result.error.message);
                button.disabled = false;
                button.innerText = "Start Subscription";
            }
        });
    });
</script>
</body>
</html>
