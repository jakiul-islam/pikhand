<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Help Center - YourStoreName</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
 
 <link rel="stylesheet" href="{{ asset('css/Help.css') }}">
</head>
<body>
  <a href="/home" class="nav-link"><i class="bi bi-arrow-left"
  style="font-size:25px;"></i></a>
    <img align='center' src="/storage/{{$webInfo->logo}}" alt="Picklet
           Logo" class='logo' >
 
 
 {!! $Help->page !!}
 
 
 
 <!-- 
 
   <h1>Help Center</h1>
  <p>Welcome to the <strong>Picklet Help Center</strong>. Here you’ll find answers to the most common questions and learn how to get support. If you don’t find what you’re looking for, our support team is always here to assist you.</p>
  
  <h2>1. How to Place an Order</h2>
  <p>Placing an order is simple:</p>
  <ul>
    <li>Browse products and select the one you like.</li>
    <li>Click “Add to Cart” and proceed to checkout.</li>
    <li>Provide your shipping details and choose a payment method.</li>
    <li>Confirm your order — and you’re done!</li>
  </ul>
  
  <h2>2. Track Your Order</h2>
  <p>After placing your order, you will receive a confirmation email with a tracking number. You can track your order status anytime from the “My Orders” section in your account dashboard.</p>
  
  <h2>3. Payment Issues</h2>
  <p>If your payment is failing or not showing up, please check the following:</p>
  <ul>
    <li>Ensure your card or account has sufficient balance.</li>
    <li>Double-check that your payment details are correct.</li>
    <li>Try an alternative payment method (e.g., bKash, Nagad, card).</li>
  </ul>
  
  <h2>4. Returns & Refunds</h2>
  <p>We accept returns within <strong>7 days</strong> of delivery for eligible products. To request a return:</p>
  <ul>
    <li>Log in to your account and go to “My Orders.”</li>
    <li>Select the order and click “Request Return.”</li>
    <li>Once approved, send the item back using our provided instructions.</li>
  </ul>
  
  <h2>5. Need More Help?</h2>
  <p>If you can’t find the answer to your question, our support team is ready to help.</p>
  
  <div class="contact-box">
    <h2>📞 Contact Support</h2>
    <p>📧 Email: jakiuli624@gmail.com</p>
    <p>📞 Phone: +880 1834426305</p>
    <p>💬 Live Chat: Available Mon–Fri, 9:00 AM – 6:00 PM</p>
  </div>
  
  <p style="margin-top: 40px; font-size: 14px; color: #777;">
    Last updated: September 25, 2025
  </p>  -->
  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>