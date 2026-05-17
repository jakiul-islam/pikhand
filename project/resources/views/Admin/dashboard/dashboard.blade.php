<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    @vite('resources/css/Admin/Common.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
   <!-- <script type="text/javascript"
   src="https://www.gstatic.com/charts/loader.js"></script>-->
    <style>
      .shipping-address{
        background-color:#E4E4E4 ;
        box-sizing: border-box;
        margin: 4px;
        display:flex;
        position: relative;
      }
      .download-div{
        position: fixed;
        bottom: 20px;
        right: 20px;
      }
    </style>
  </head>
  <body>
   @include("Admin.Include.header")
    <div class="main-contain" id="maindiv">
      <input type="hidden" value="{{ $webInfo->logo }}" id="webLogo">
      <button class="btn btn-outline-success" onclick="googlechart();">Dashboard</button>
      <button class="btn btn-outline-success" onclick="processingOrder();">Prosseccing order</button>
      <button class="btn btn-outline-success" onclick="productStokLimit();">Stock lemit</button>
      <button class="btn btn-outline-success" onclick="NewOrder();">New order</button>
      <div id='Adminpagediv' class="container-fluid" style="display:none;">
      </div>
      <div id='allchart'>
        <div id="users_chart" style="width: 100%; height: 400px;"></div>
        <div id="orders_chart" style="width: 100%; height: 400px;"></div>
        <div id="order_item_chart" style="width: 100%; height: 400px;"></div>
        <div id="product_chart" style="width: 100%; height: 400px;"></div>
        <div id="sales_chart" style="width: 100%; height: 400px;"></div>
        <div id="cart_chart" style="width: 100%; height: 400px;"></div>
      </div>
    </div>
  </body>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

     //Daily User Registrations
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(Registrations);

      function Registrations() {
        var userdata = google.visualization.arrayToDataTable(@json($userData));


        var options = {
          title: 'Daily User Registrations',
          curveType: 'function',
          legend: { position: 'bottom' },
          backgroundColor: 'transparent',
          hAxis: {
            title: 'Date',
            slantedText: true, // তারিখগুলো কাত হয়ে দেখাবে
            slantedTextAngle: 45
          },
          vAxis: {
            title: 'Number of Users'
          }
        };

        var chart = new google.visualization.LineChart(document.getElementById('users_chart'));
        chart.draw(userdata, options);
      }

      //Daily Orders Count
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(Orders);

      function Orders() {
        var Ordersdata = google.visualization.arrayToDataTable(@json($orderData));

        var options = {
          title: 'Daily Orders Count',
          backgroundColor: 'transparent',
          legend: { position: 'none' },
          hAxis: {
            title: 'Date',
            slantedText: true,
            slantedTextAngle: 45
          },
          vAxis: {
            title: 'Number of Orders'
          },
          colors: ['#4285F4'] // নীল রঙের বার
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('orders_chart'));
        chart.draw(Ordersdata, options);
      }

    //Top Selling Products

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(Selling);

    function Selling() {
      var Sellingdata = google.visualization.arrayToDataTable(@json($orderproductData));

      var options = {
        title: 'Top Selling Products',
        is3D: true,
        backgroundColor: 'transparent',
        legend: { position: 'right' },
      };

      var chart = new google.visualization.PieChart(document.getElementById('order_item_chart'));
      chart.draw(Sellingdata, options);
    }

//স্টকে থাকা পণ্যের

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(productStock);

    function productStock() {
      var productStockdata = google.visualization.arrayToDataTable(@json($productData));

      var options = {
        title: 'product stock',
        is3D: true,
        backgroundColor: 'transparent',
        legend: { position: 'right' },
      };

      var chart = new google.visualization.PieChart(document.getElementById('product_chart'));
      chart.draw(productStockdata, options);
    }

//দৈনিক বিক্রির পর

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(dalySells);

    function dalySells() {
      var dalySellsdata = google.visualization.arrayToDataTable(@json($salesData));

      var options = {
        title: 'Daily Sells Amount',
        hAxis: { title: 'তারিখ' },
        vAxis: { title: 'টাকা' },
        backgroundColor: 'transparent',
        legend: { position: 'bottom' },
        areaOpacity: 0.3,
      };

      var chart = new google.visualization.AreaChart(document.getElementById('sales_chart'));
      chart.draw(dalySellsdata, options);
    }

//কার্টে কিছু যোগ করেছেন কিন্তু চেকআউট

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(cartChart);

    function cartChart() {
      var cartChartdata = google.visualization.arrayToDataTable(@json($chartData));


      var options = {
        title: 'Added to cart but did not checkout',
        hAxis: { title: 'তারিখ' },
        vAxis: { title: 'ইউজারের সংখ্যা' },
        backgroundColor: 'transparent',
        legend: { position: 'none' },
        colors: ['#4285F4'],
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('cart_chart'));
      chart.draw(cartChartdata, options);
    }

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  @vite([
    'resources/js/Admin/common.js',
    'resources/js/Admin/dashboard/dashboard.js',
    'resources/js/Admin/dashboard/DashboardStokLimit.js',
    'resources/js/Admin/dashboard/google-chart.js'
  ])

</html>
