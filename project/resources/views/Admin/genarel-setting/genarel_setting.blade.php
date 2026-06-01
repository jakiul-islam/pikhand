<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link rel="stylesheet" href="{{ asset('public/css/Admin/Common.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <script src="{{ asset('public/tinymce/tinymce.min.js') }}"></script>
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
   @include("Admin.Include.Header")
    <div class="main-contain">

      <div class="name-2">
        <h1>web name  </h1>
        <h3 id='WebNameshow'> </h3>
        <h1>web logo </h1>
        <img id="WebLogoshow">
        <button class="edit-button btn btn-primary" type="button" 
        data-bs-toggle="modal" data-bs-target="#InsertLogo">
          insert logo
        </button>
        
      </div>
      <div class="name-2">
        <h1>Notice Name </h1>
        <h3 id='notisName'> </h3>
        <h1>Notice Description</h1>
        <h3 id='notisDescription'></h3>
        <button class="edit-button btn btn-primary" type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">
          insert notise
        </button>
        <div class="form-check form-switch mt-3" style="position:absolute;
        top:10px; right:10px;">
          <input class="form-check-input shadow-none" id="showswitch" type="checkbox"  role="switch" id="flexSwitchCheckDefault">
        </div>
      </div>
   <!-- newsletter insert section-->
      <div class="name-2">
        <h1>News title</h1>
        <p id='newstitleshow' > </p>
        <h1>News subtitle</h1>
        <p id='newssubtitleshow'></p>
        <h1>News subtitle 2</h1>
        <p id='newssubtitle_2show'></p>
        
      <button class="edit-button btn btn-primary" type="button" 
       data-bs-toggle="modal" data-bs-target="#newsletter">
         insert newsletter
       </button> 
      </div>
      
      <!-- contruct us section-->
      <div class="name-2">
        <button type="button" class="btn btn-primary text-center"
       data-bs-toggle="modal" data-bs-target="#mediaForm">
         Insert media
       </button> 
        <div id='allmedia'>
        </div>
      </div>

   </div>
   
   <div id="showalert"></div>
   
     <!-- all model site  -->
      <div class="modal fade InsertLogo" id="InsertLogo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label>web name</label><br>
              <input type="text" id='webName' value=""><br>
              <label>Web logo</label> <br>
              <input type="file" class='' id="Web_Iogo">
              <img id="logoPreview" height="100" >
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" id='insertWebLogobutton'
              onclick="insertWebLogo()">Insert notise</button>
            </div>
          </div>
        </div>
      </div>
 
     <!-- Modal -->
      <div class="modal fade notiseinsert" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label>notis name</label><br>
              <input type="text" id='notise_name' value=""><br>
              <label>notise description</label> <br>
              <textarea class='description' id="notise_description"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" id='insertnoisebutton'
              onclick="insertnotise()">Insert notise</button>
            </div>
              </form>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade notiseinsert" id="newsletter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Newsletter</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                      
            <div class="modal-body">
              <label>Newstitle</label><br>
              <textarea  id='News_title'  rows="2" style="width:100%;"></textarea><br>
              <label>newssubtitle</label> <br>
              <textarea rows="2" style="width:100%;" id="newssubtitle"></textarea><br>
              <label>newssubtitle 2</label> <br>
              <textarea rows="2" style="width:100%;" id="newssubtitle_2"></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button  id='insetnewsletterbutton'
              onclick="insertnewsletter()">Insert newsletter</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="mediaForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Media Form</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                      
            <div class="modal-body">
              <label>Media type</label><br>
              <input type='text' id='mediaType'><br>
              <label>Media url</label> <br>
              <input type='text' id='mediaUrl'><br>
              <label>Media icon</label> <br>
              <input type='text' id='mediaIcon'><br>
              <label>Media Id name</label><br>
              <input type='text' id='mediaIdName'><br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button  id='mediaButton' onclick="insertMediaLinks()">Insert Media Links</button>
            </div>
          </div>
        </div>
      </div>
    
    
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/Admin/common.js') }}"></script>
    <script src="{{ asset('public/js/Admin/genarel-setting/Newsletter.js') }}"></script>
    <script src="{{ asset('public/js/Admin/genarel-setting/index.js') }}"></script>
    <script src="{{ asset('public/js/Admin/genarel-setting/web-logo.js') }}"></script>
    <script src="{{ asset('public/js/Admin/media-links.js') }}"></script>

  </body>
</html>