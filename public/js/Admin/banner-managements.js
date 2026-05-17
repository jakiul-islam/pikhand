        $(document).ready(function() {
          $("#insertclose").click(function() {
            const previewImage = document.querySelector("#previewImage");
            $('#serviceName').val('');
            $('#serviceSlog').val('');
            $('#imageInput').val('');
            $('#min_price').val(''); // Don't forget this if you want to clear it too
            previewImage.style.display = 'none';
          });
        });
        //banner create
        $(document).ready(function(){
          $("#insertBannerButton").click(function(){
            const previewImage = document.querySelector("#previewImage");
            let formData = new FormData();
              formData.append('bannerName', $('#bannerName').val());
              formData.append('bannerSlog', $('#bannerSlog').val());
              formData.append('imageInput', $('#imageInput')[0].files[0]);
              formData.append('bannerDescription', $('#bannerDescription').val());


              sendDataAjax('/admin/insert_banners',formData,'post','fetchBanner','Nan','insertBannerButton','Insert','banner');

              $('#bannerName').val('');
              $('#bannerSlog').val('');
              $('#bannerDescription').val('');

          });
        });
        //index


        window.fetchBanner = function(){
          fetchDataAjax('/admin/fetch_banner','get','bannersData','Nan');
        }

        fetchBanner();



        window.bannersData  = function( response ){
          $('.editor-modal').remove();
          $('#allbanners').html(''); // পুরানো ডাটা মুছে ফেলবে
          $.each(response, function(index, banners) {
            let vewlId = `vew${index}`;
            let editeId = `edite${banners.id}`;
            let DelmodalId = `DelModal${index}`;
            $('#allbanners').append(`
              <tr>
                <td>${banners.id}</td>
                <td style="width:5px;">${banners.name}</td>
                <td>${banners.slug}</td>
                <td>${banners.description}</td>
                <td><img src="/storage/${banners.image}" width="100" alt="${banners.name}"></td>
                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#${vewlId}">View</button></td>
                <td><button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#${editeId}">edite</button></td>
                <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#${DelmodalId}">delete</button></td>
              </tr>
            `);
            $('body').append(`
              <div class="modal fade editor-modal" id="${vewlId}" tabindex="-1" aria-labelledby="${vewlId}Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="${vewlId}Label">banner motels</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <h1 class='text-center'>${banners.name}</h1>
                      <p>id:${banners.id}</p>
                      <p>${banners.slug}</p>
                      <p>${banners.description}</p>
                      <img src="/storage/${banners.image}" class="img-fluid" alt="${banners.name}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade editor-modal  editeModel" id="${editeId}" tabindex="-1" aria-labelledby="${editeId}Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="${editeId}Label">edit  this banner</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="input-group flex-nowrap">
                        <input type='hidden' id='Editeid' value='${banners.id}'>
                        <span class="input-group-text" id="addon-wrapping">name</span>
                        <input type="text" id="Editeservicename" value='${banners.name}' class="form-control" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
                      </div>
                      <br>
                      <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">slug</span>
                        <input type="text" id="EditeserviceSlug" value='${banners.slug}' class="form-control" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
                      </div>
                      <br>
                      <div class="input-group flex-nowrap">
                        <input type="hidden" id="old_image" value="${banners.image}">
                        <input type="file"  id="imageInput1" class="form-control" placeholder="prodect-name" aria-label="Username" aria-describedby="addon-wrapping">
                        <img id="previewImage1" src="/storage/${banners.image}" alt="Image Preview" style="max-width: 200px; max-height:100px; display: none;">
                        <img id="oldImg" src="/storage/${banners.image}" alt="Image Preview" style="max-width: 200px; max-height:100px; ">
                      </div><br>
                        <span class="input-group-text"
                        id="addon-wrapping">banner description</span>
                      <div class="input-group flex-nowrap">
                        <textarea id="bannersBescription" class='editedescription'>${banners.description}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" id='editebutton${banners.id}' class="btn
                      btn-primary EditeSaveButton">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade deleteModel editor-modal" id="${DelmodalId}" tabindex="-1" aria-labelledby="${DelmodalId}Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="${DelmodalId}Label">${banners.name}</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type='hidden' id='deleteId' value='${banners.id}'>
                      <p>${banners.name}</p>
                      <img src="/storage/${banners.image}" class="img-fluid" alt="${banners.name}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" id="deletebutton" class="btn btn-danger deletebutton${banners.id}">delete</button>
                    </div>
                  </div>
                </div>
              </div>
            `);
          });
        }
        //banner update
        $(document).ready(function(){
          $(document).on("click", ".EditeSaveButton", function(){

            let Editeid         = $(this).closest('.modal-content').find('#Editeid').val();

            let fileInput         = document.getElementById('imageInput1');
            let EditeBannersName    = $(this).closest('.modal-content').find('#Editeservicename').val();
            let EditeBannersSlug    = $(this).closest('.modal-content').find('#EditeserviceSlug').val();
            let old_image         = $(this).closest('.modal-content').find('#old_image').val();
            let Editeminprice     = $(this).closest('.modal-content').find('#editemin_price').val();

            let formData = new FormData();
            if (fileInput.files.length > 0) {
              formData.append('imageInput1', fileInput.files[0]);
            }
            formData.append('Editeid', Editeid);
            formData.append('EditeBannersName', EditeBannersName);
            formData.append('EditeBannersSlug', EditeBannersSlug);
            formData.append('EditeMinPrice', Editeminprice);
            formData.append('old_image', old_image);

            sendDataAjax('/admin/edite_banners',formData,'post','fetchBanner','Nan','editebutton'+Editeid,'Save change','edite'+Editeid );

          });
        });
        //end banners change function
        //delete

      $(document).ready(function(){
        $(document).on("click", "#deletebutton", function(){
          let deleteId = $(this).closest('.modal-content').find('#deleteId').val();
          const prodectInsertButton =document.querySelector(".deletebutton"+deleteId);
          prodectInsertButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status">Loading...</span>
          `;
          prodectInsertButton.disabled = true;

          const DeleteInputerror =document.querySelector("#editeInputerror");

          let formData = new FormData();
          formData.append('deleteId', deleteId);
          $.ajax({
            url : '/admin/deleteservices',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
              prodectInsertButton.innerHTML = `delete`;
              prodectInsertButton.disabled = false;

              var modal = bootstrap.Modal.getInstance(document.querySelector('.deleteModel.show'));
              modal.hide();
              fetchBanner();
            },
            error:function(xhr,status,error){
              prodectInsertButton.innerHTML = `delete`;
              prodectInsertButton.disabled = false;

              alert ('Error:'+ xhr.responseText);
              console.log(xhr.responseText);
            }
          });
        });
      });

      //img previews
      $(document).on("change", "#imageInput1", function (event) {
        let file = event.target.files[0];
        let oldImg =document.querySelector("#oldImg");
        if (file) {
          let reader = new FileReader();
          reader.onload = function (e) {
          $("#previewImage1").attr("src", e.target.result).show();
            oldImg.style.display='none';
          };
          reader.readAsDataURL(file);
        }
      });
      //textarea
    $(document).on("shown.bs.modal", ".editor-modal", function () {
    const $textarea = $(this).find(".editedescription");
    // প্রতিটি textarea এর জন্য আলাদা id তৈরি করুন যদি না থাকে
    $textarea.each(function() {
        const $this = $(this);
        if (!$this.attr("id")) {
            $this.attr("id", "editor_" + Math.random().toString(36).substr(2, 9));
        }
        // টিনিমসি ইনস্ট্যান্স চেক এবং তৈরি করা
        if (tinymce.get($this.attr("id"))) {
            tinymce.get($this.attr("id")).remove();
        }
        tinymce.init({
            selector: `#${$this.attr("id")}`,
            plugins: 'autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
            toolbar: 'undo redo | bold italic underline strikethrough | link image media table | alignleft aligncenter alignright alignjustify | numlist bullist | removeformat',
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    });
});

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.getElementById('previewImage');
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
