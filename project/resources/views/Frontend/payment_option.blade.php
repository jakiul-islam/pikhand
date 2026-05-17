<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard - Payment Options</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background: #f2f5f9;
      font-family: 'Poppins', sans-serif;
    }
    .dashboard {
      max-width: 1000px;
      margin: 40px auto;
    }
    .card-custom {
      transition: all 0.3s ease;
      border-radius: 12px;
    }
    .card-custom:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .table th {
      background-color: #007bff;
      color: #fff;
    }
    .form-control, .btn {
      border-radius: 8px;
    }
    .section-title {
      border-left: 4px solid #007bff;
      padding-left: 10px;
      font-weight: 600;
      margin-bottom: 20px;
    }
    .bi-arrow-left{
      font-size: 20px;
    }
  </style>
</head>
<body>

<div class="dashboard bg-white shadow p-4 rounded-4">
  <a href="/home"><i class="bi bi-arrow-left"></i></a>
  <h2 class="text-center text-primary mb-5 fw-bold">💳 Payment Options</h2>

  <!-- Payment Methods -->
  <section class="mb-5">
    <h4 class="section-title">Available Payment Methods</h4>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card card-custom border-0 shadow-sm text-center p-3 h-100">
          <img src="https://i.imgur.com/B4t7Xnl.png" width="80" class="mx-auto mb-3" alt="bKash">
          <h6>bKash</h6>
          <p class="text-muted small">Send money directly from your bKash wallet.</p>
          <button class="btn btn-outline-primary btn-sm">Use This</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom border-0 shadow-sm text-center p-3 h-100">
          <img src="https://i.imgur.com/fKxQj2T.png" width="80" class="mx-auto mb-3" alt="Nagad">
          <h6>Nagad</h6>
          <p class="text-muted small">Pay securely using Nagad mobile banking.</p>
          <button class="btn btn-outline-primary btn-sm">Use This</button>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-custom border-0 shadow-sm text-center p-3 h-100">
          <img src="https://i.imgur.com/R8mS7Bj.png" width="80" class="mx-auto mb-3" alt="Card">
          <h6>Credit / Debit Card</h6>
          <p class="text-muted small">Pay easily with Visa or MasterCard.</p>
          <button class="btn btn-outline-primary btn-sm">Use This</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Add New Payment Method -->
  <section class="mb-5">
    <h4 class="section-title">Add New Payment Method</h4>
    <form class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Name on Card</label>
        <input type="text" class="form-control" placeholder="e.g. Zakir Islam" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Card Number</label>
        <input type="text" class="form-control" placeholder="**** **** **** 1234" required>
      </div>
      <div class="col-md-2">
        <label class="form-label">Expiry</label>
        <input type="text" class="form-control" placeholder="MM/YY" required>
      </div>
      <div class="col-md-2">
        <label class="form-label">CVV</label>
        <input type="password" class="form-control" maxlength="3" placeholder="***" required>
      </div>
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary px-4">Save Method</button>
      </div>
    </form>
  </section>

  <!-- Payment History -->
  <section>
    <h4 class="section-title">Payment History</h4>
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead>
          <tr>
            <th>Date</th>
            <th>Order ID</th>
            <th>Method</th>
            <th>Amount</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>21 Oct 2025</td>
            <td>#ORD124</td>
            <td>bKash</td>
            <td>৳1,250</td>
            <td><span class="badge bg-success">Paid</span></td>
          </tr>
          <tr>
            <td>19 Oct 2025</td>
            <td>#ORD119</td>
            <td>COD</td>
            <td>৳2,100</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
          </tr>
          <tr>
            <td>15 Oct 2025</td>
            <td>#ORD102</td>
            <td>Card</td>
            <td>৳3,500</td>
            <td><span class="badge bg-danger">Failed</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>