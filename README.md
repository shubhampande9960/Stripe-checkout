# Stripe Checkout PHP Integration

This project demonstrates how to integrate **Stripe Checkout** using PHP.

If you're seeing an error like:

```
Warning: require_once(vendor/autoload.php): Failed to open stream...
Fatal error: Failed opening required 'vendor/autoload.php'
```

It means the **Stripe PHP library is missing** — and needs to be installed via **Composer**.

---

## 🔧 Fix: Install Stripe PHP SDK Using Composer

### ✅ Step-by-Step:

1. **Open Command Prompt** in your project directory:

   ```bash
   cd C:\wamp64\www\Stripe-checkout-main
   ```

2. **Run Composer install for Stripe**:

   ```bash
   composer require stripe/stripe-php
   ```

3. This will:
   - Create a `vendor/` directory
   - Generate `vendor/autoload.php` (used in your PHP script)

---

##  After Installation:

Ensure your PHP file includes the Stripe SDK like this:

```php
<?php
require_once('vendor/autoload.php');
```

---

## Don't Have Composer Installed?

If you get the error:

```
'composer' is not recognized as an internal or external command...
```

Then:

1. Download Composer from: [https://getcomposer.org](https://getcomposer.org)
2. Install it using the setup wizard
3. Restart your Command Prompt (or terminal)

---

## Final Project Structure

After installation, your file tree should look like:

```
Stripe-checkout-main/
├── vendor/
│   └── autoload.php
├── index.php
└── composer.json
```

---

## All Set!

Now refresh your browser or run your script again — and the Stripe integration will work correctly.

Need help customizing the checkout or adding more features? [Stripe Docs](https://stripe.com/docs/checkout) has you covered!
