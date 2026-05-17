
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    /* যখন স্ক্রিন 500px এর বেশি */
    @media (min-width: 990px) {
      .offcanvas {
        position: fixed !important;
        visibility: visible !important;
        transform: none !important;
        top: 0;
        right: 0;
        height: 100vh;
        width: 300px !important;
        border-left: 1px solid #ddd;
        background-color: #f8f9fa;
      }

      /* Navbar-toggler বোতাম লুকাও */
      .navbar-toggler {
        display: none;
      }
      /* Navbar এর কনটেন্ট যাতে 200px এর জায়গা বাদে থাকে */
      body {
        margin-left: 300px;
      }
    }
    .offcanvas-header{
      height:56px;
    }
    .adminEmail{
      display: inline-block;
      width:200px;
      overflow: auto;
      margin-top: -4px;
      vertical-align: middle;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }
  </style>
</head>
<body>

<nav class="navbar bg-success fixed-top">
  <div class="container-fluid">
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas"  data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="emailAndButton navbar-brand ms-auto text-white">
      <span class="adminEmail"> {{ session('admin_email') }} </span>
      <a class='btn btn-outline-warning' href="/logout">Logout</a>
    </div>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
      aria-labelledby="offcanvasNavbar">
      <div class="offcanvas-header bg-success">
        <h5 class="offcanvas-title" id="offcanvasNavbar">Menu</h5>
        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>



      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

          <li class="nav-item"><a class="nav-link" href="/admin/dashboord/">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/order/">Order Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/cart/">Cart Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/user/">User Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/admin-list/">Admin Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Payment/">Payment Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Review/">Review Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Security_Settings/">Security Settings</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/genaler_setting/">General Settings</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.product') }}"  style="padding-left:5px; padding-right:5px;  {{  request()->routeIs('admin.product') ? 'color' : 'green;' }}">Product Management</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('admin.banner') }}"  style="padding-left:5px; padding-right:5px;  {{ request()->routeIs('admin.banner') ? 'border:solid #FFFFFF 1px;' : '' }}">banner managements</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/category">Category Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Brand">Brand Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/seo_satting">SEO Settings</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Vouchers/">Vouchers Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Help/">Help Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/Policies/">Policy Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/About/">About Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/reports/">Reports</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/analytics/">Analytics</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/faq/">FAQ Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/testimonials/">Testimonial Management</a></li>
          <li class="nav-item"><a class="nav-link" href="/admin/newsletter/">Newsletter Management</a></li>
          <br><br>
        </ul>
      </div>



    </div>
  </div>
</nav>
<!--
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 -->
<br><br><br>


<div id='showalert'></div>
<div id='pdfdownloadButton'></div>
