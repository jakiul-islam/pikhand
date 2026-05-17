<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/Common.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <script src="{{ asset('tinymce/tinymce.min.js') }}"></script>
    <script>
  tinymce.init({
    selector: '.description',
    plugins: 'autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
    toolbar: 'undo redo | bold italic underline strikethrough | link image media table | alignleft aligncenter alignright alignjustify | numlist bullist | removeformat',
    setup: function (editor) {
      editor.on('change', function () {
        tinymce.triggerSave(); // Ensures textarea updates with editor content
      });
    }
  });
</script>
  </head>
  <body>
   @include("Admin.Include.header")
    <div class="main-contain">
      <button class="btn btn-outline-success" onclick="PasswordPolicies();">Password Policies</button>
      <button class="btn btn-outline-success">2FA Setting</button>
      <button class="btn btn-outline-success">Access Control</button>
      <button class="btn btn-outline-success">Session Management</button>
      <button class="btn btn-outline-success">Encryption</button>
      <button class="btn btn-outline-success">Firewall & Security Scanning</button>

      
      <div class="name-2" id='showContain'>
      </div>
    </div>

    
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/Admin/Security_Settings.js') }}"></script>
    <script src="{{ asset('js/Admin/common.js') }}"></script>
  </body>
</html>