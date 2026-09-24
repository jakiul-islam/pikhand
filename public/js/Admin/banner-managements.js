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
              previewImage.style.disply = "none";
          });
        });
        //index


        window.fetchBanner = function(){
          fetchDataAjax('/admin/fetch_banner','get','bannersData','Nan');
        }

        fetchBanner();

        window.bannersData  = function( response ){
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
                <td><button type="button" onclick="viewDateSet('${banners.id}','${banners.name}','${banners.slug}','${banners.description}','${banners.image}')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewModel">View</button></td>
                <td><button type="button" onclick="EditDateSet('${banners.id}','${banners.name}','${banners.slug}','${banners.description}','${banners.image}')" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#EditBannerModel">edite</button></td>
                <td><button type="button" onclick="deleteDateSet('${banners.id}','${banners.name}','${banners.slug}','${banners.description}','${banners.image}')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBannerModel">delete</button></td>
              </tr>
            `);

            
           
          });
        }


        window.viewDateSet = function(id , name , slug , description ,image ){
          let bannerName = document.getElementById('bannerNameView');
          let bannerId = document.getElementById('bannerId');
          let bannerSlug = document.getElementById('bannerSlug');
          let bannerDescription = document.getElementById('bannerDescriptionView');
          let bannerImg = document.getElementById('bannerImg');

           bannerName.innerHTML = name;
           bannerId.innerHTML = id;
           bannerSlug.innerHTML = slug;
           bannerDescription.innerHTML = description;
           bannerImg.src = "/storage/" +image;


          
        }
       
        window.EditDateSet = function(id , name , slug , description ,image ){
          let bannerName = document.getElementById('EditBannerName');
          let bannerId = document.getElementById('EditBannerId');
          let bannerSlug = document.getElementById('EditBannerSlug');
          let previewImage1 = document.getElementById('previewImage1');

           bannerName.value = name;
           bannerId.value = id;
           bannerSlug.value = slug;
           tinymce.get('EditBannersDescription').setContent(description);
           previewImage1.src = "/storage/" +image;
          
        }
       
        window.deleteDateSet = function(id , name , slug , description ,image ){
          let bannerName = document.getElementById('deleteBannerName');
          let bannerId = document.getElementById('deleteBannerId');
          let deleteBannerimg = document.getElementById('deleteBannerimg');

           bannerName.innerHTML = name;
           bannerId.value = id;
           deleteBannerimg.src = "/storage/" +image;
          
        }



        //banner update
        $(document).ready(function(){
          $(document).on("click", ".EditeSaveButton", function(){

          let bannerName = document.getElementById('EditBannerName').value;
          let bannerId = document.getElementById('EditBannerId').value;
          let bannerSlug = document.getElementById('EditBannerSlug').value;
          let bannerDescription = tinymce.get('EditBannersDescription').getContent()

          let fileInput = document.getElementById('imageInput1');

            
            let formData = new FormData();
            if (fileInput.files.length > 0) {
              formData.append('imageInput1', fileInput.files[0]);
            }
            formData.append('Editeid', bannerId);
            formData.append('EditeBannersName', bannerName);
            formData.append('EditeBannersSlug', bannerSlug);
            formData.append('bannerDescription', bannerDescription);

            sendDataAjax('/admin/edite_banners',formData,'post','fetchBanner','Nan','editebuttonbanner','Save change','EditBannerModel' );

          });
        });
        //end banners change function
        //delete

      $(document).ready(function(){
        $(document).on("click", "#bannerDeletebutton", function(){


          let formData = new FormData();
          formData.append('deleteId', bannerDescription);

           sendDataAjax('/admin/deleteservices',formData,'post','fetchBanner','Nan','editebuttonbanner','Save change','EditBannerModel' );

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
