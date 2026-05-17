<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Affiliate Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      background: #f4f6fb;
      font-family: 'Poppins', sans-serif;
    }
    .affiliate-dashboard {
      max-width: 1100px;
      margin: 40px auto;
    }
    .card-custom {
      border-radius: 14px;
      transition: 0.3s;
      border: none;
    }
    .card-custom:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
    .affiliate-link-box {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }
    .copy-btn {
      border-radius: 8px;
    }
    .table th {
      background-color: #007bff;
      color: #fff;
    }
    .bi-arrow-left{
      font-size: 20px;
    }
  </style>
</head>
<body>

<div class="affiliate-dashboard bg-white p-4 shadow rounded-4">
  <a href="/home"><i class="bi bi-arrow-left"></i></a>
  <h2 class="text-center text-primary fw-bold mb-4">🤝 My Affiliate Dashboard</h2>

  <!-- Affiliate Link Section -->
  <section class="affiliate-link-box mb-5">
    <h5>Your Affiliate Link</h5>
    <p class="text-muted small">Share this link with your friends and earn commissions when they purchase.</p>
    <div class="input-group">
      <input type="text" class="form-control" value="https://yourshop.com/register?ref=ZAKIR123" readonly>
      <button class="btn btn-primary copy-btn" onclick="copyLink()">Copy</button>
    </div>
  </section>

  <!-- Stats Cards -->
  <section class="row text-center mb-5">
    <div class="col-md-4 mb-3">
      <div class="card card-custom p-4 shadow-sm">
        <h6>Total Clicks</h6>
        <h2 class="text-primary">54</h2>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card card-custom p-4 shadow-sm">
        <h6>Total Commission</h6>
        <h2 class="text-success">৳ 850</h2>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card card-custom p-4 shadow-sm">
        <h6>Pending Commission</h6>
        <h2 class="text-warning">৳ 120</h2>
      </div>
    </div>
  </section>

  <!-- Payment History -->
  <section class="mb-5">
    <h5 class="fw-bold mb-3">💰 Payment History</h5>
    <div class="table-responsive">
      <table class="table table-striped align-middle text-center">
        <thead>
          <tr>
            <th>Date</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Transaction ID</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>21 Oct 2025</td>
            <td>৳ 230</td>
            <td><span class="badge bg-success">Paid</span></td>
            <td>#TXN7845</td>
          </tr>
          <tr>
            <td>18 Oct 2025</td>
            <td>৳ 120</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td>#TXN6521</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Referral Users -->
  <section>
    <h5 class="fw-bold mb-3">👥 Referred Users</h5>
    <div class="table-responsive">
      <table class="table table-hover align-middle text-center">
        <thead>
          <tr>
            <th>User Name</th>
            <th>Order ID</th>
            <th>Commission</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Rafi Ahmed</td>
            <td>#ORD102</td>
            <td>৳ 80</td>
            <td><span class="badge bg-success">Paid</span></td>
          </tr>
          <tr>
            <td>Hasan Ali</td>
            <td>#ORD107</td>
            <td>৳ 70</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</div>

<script>
function copyLink() {
  const link = document.querySelector('.affiliate-link-box input');
  link.select();
  document.execCommand('copy');
  alert('Affiliate link copied!');
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>