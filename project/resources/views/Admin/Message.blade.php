<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>Pikhand admin massanger </title>
  <!-- All css link add section --> 
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Message.css') }}">
  <!-- bootstrap link add section --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- ajax link add section--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<body>
  @include("Admin.Include.Header")

    <div class='massanger row'>
      <div class='col-md-5 col-lg-5 user-container'>
        <div class="user-header">
          <div class="header-name">
              Messages
          </div>
          <div class="search">
              <input type="text" id='messagesUserSearch' oninput='indexAllUser()' placeholder="Search messages...">
          </div>
        </div>
        <div class="user-list">
          <br>
          <br>
          <br>
         <br>
          1jakiul islam<br>
           2jakiul islam<br>
           3jakiul islam <br>
           4jakiul islam<br>
           5jakiul islam<br>
          jakiul islam<br>
           jakiul islam<br>
           jakiul islam <br>
           jakiul islam<br>
           jakiul islam<br>
          jakiul islam<br>
           jakiul islam<br>
           jakiul islam <br>
           jakiul islam<br>
          6 jakiul islam<br>
          5 jakiul islam<br>
          4 jakiul islam<br>
          3 jakiul islam <br>
          2 jakiul islam<br>
          1 jakiul islam<br>
          <br>
        </div>
      </div>
      <div class='col-md-5 col-lg-5 message-contaner'>
        <h1>jakiul right</h1>
      </div>
    </div>



  

  
    <!-- bootstrap script link -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- script link  -->
      <script src="{{ asset('public/js/Admin/common.js') }}"></script>
      <script src="{{ asset('public/js/Admin/Message.js') }}"></script>
</body>
</html>