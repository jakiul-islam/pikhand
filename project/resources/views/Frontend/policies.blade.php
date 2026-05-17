<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Store Policies - YourStoreName</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/Policies.css') }}">
</head>
<body>
  <a href="/home" class="nav-link"><i class="bi bi-arrow-left"
  style="font-size:25px;"></i></a>
  <img align='center' src="/storage/{{$webInfo->logo}}" alt="Picklet
           Logo" class='logo' >
           
           
           {!! $Policies->page  !!}
  
  <!--
  <h1>Store Policies</h1>
  <p>Welcome to <strong>YourStoreName</strong>. Please read our store policies carefully before making a purchase. By using our website, you agree to the following terms and conditions:</p>

  <h2>1. Shipping Policy</h2>
  <p>We aim to process and ship all orders within <strong>2–5 business days</strong>. Delivery times may vary based on your location and shipping method.</p>
  <ul>
    <li>Domestic orders: 3–7 business days.</li>
    <li>International orders: 10–20 business days.</li>
    <li>We are not responsible for delays caused by courier services or customs clearance.</li>
  </ul>

  <h2>2. Return & Refund Policy</h2>
  <p>We want you to be 100% satisfied with your purchase. If you are not, you may request a return or exchange within <strong>7 days</strong> of receiving your order.</p>
  <ul>
    <li>Items must be unused, undamaged, and in their original packaging.</li>
    <li>Refunds will be processed to the original payment method within 7–14 business days after receiving the returned item.</li>
    <li>Shipping charges are non-refundable.</li>
  </ul>

  <h2>3. Privacy Policy</h2>
  <p>We value your privacy. All personal information collected on our website is used solely for order processing, shipping, and customer support. We do not share your data with third parties without your consent, except as required by law.</p>

  <h2>4. Payment Policy</h2>
  <p>We accept the following payment methods:</p>
  <ul>
    <li>Credit/Debit Cards</li>
    <li>Mobile Payment (e.g., bKash, Nagad)</li>
    <li>Cash on Delivery (COD)</li>
  </ul>
  <p>All payments must be completed before the order is shipped, except for COD orders.</p>

  <h2>5. Cancellation Policy</h2>
  <p>Orders can be canceled within <strong>12 hours</strong> of placement. Once the order is shipped, it cannot be canceled.</p>

  <h2>6. Contact Us</h2>
  <p>If you have any questions about our policies, feel free to contact us:</p>
  <p>
    📧 Email: support@yourstorename.com<br>
    📞 Phone: +880 1XXX-XXXXXX<br>
    🏢 Address: Your Store Address, City, Country
  </p>  

  <p><em>Last Updated: September 25, 2025</em></p>   -->
  <script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
  crossorigin="anonymous"></script>
</body>
</html>