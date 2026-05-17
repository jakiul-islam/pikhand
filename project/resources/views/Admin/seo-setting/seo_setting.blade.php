<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jis food admin panale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
  <style>
      *{
          box-sizing: border-box;
      }
      .main-contain{
          margin: 10px;
      }
      @media (min-width:992px){
          .main-contain{
          margin-left: 400px;
         }
      }
      .edit-button{
          position:absolute;
          right: 10px;
          bottom:10px;
      }
      .name-1{
          display: inline-block;
      }
      .name-2{
          padding: 10px;
          border:1px solid black;
          margin: 10px;
          position: relative;
      }
      .alartdiv{
        z-index: 1300;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 30px;
        display:block;
        line-height: 1;
        width: auto;
        padding:10px;
        font-size: 20px;
        margin-top: 10px;
        margin-bottom: 10px;
        display:none;
      }
      .buttontext{
        background: none;
        border: none;
        color:#ffffff;
      }
      </style>
    </style>
  </head>
  
  <body>
   @include("Admin.include.header")
   <div class="main-contain">
       <div class="name-2">
           <h1>Site-wide SEO Settings</h1>
           <h3 onclick="fetch_seo();" style="width:300px;" class="alartdiv" id='faildalert'>successfull</h3>
           <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#name">
            Change
         </button>
       </div>
       
       <!-- prodect show table -->
      <div style="overflow:auto; width:100%;">
        <table class="table table-dark table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Site Name</th>
              <th scope="col">Tagline</th>
              <th scope="col">Default Meta Title</th>
              <th scope="col">Default Meta Description</th>
              <th scope="col">Default OG Image</th>
              <th scope="col">Favicon</th>
              <th scope="col">Google Analytics ID</th>
              <th scope="col">Search Console Code</th>
              <th scope="col">Webmaster Code</th>
              <th scope="col">Schema Organization JSON</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id='show_seodata'>
            <tr>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!--page seo setting -->
      <div class="name-2">
          <h1>Add Page SEO</h1>
           <h3 class="alartdiv" style='width:300px;'
           id='pageSuccessfullalert'></h3>
           <button class="edit-button" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#page_seo_model">
            Change
         </button>
      </div>
      
      
      <div style="overflow:auto; width:100%;">
        <table class="table table-dark table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Page URL</th>
              <th scope="col">Meta title</th>
              <th scope="col">Meta description</th>
              <th scope="col">Meta Keywords</th>
              <th scope="col">OG Image (URL)</th>
              <th scope="col">Canonical URL</th>
              <th scope="col">Robots Meta</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id='page_show_seodata'>
            <tr>
            </tr>
          </tbody>
        </table>
      </div>
      
   </div>
   <!-- all model site -->
   <!-- Modal -->
        <div class="modal fade" id="name" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Site-wide SEO Settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    <table>
                      <tr>
                        <td><label for="site_name">Site Name</label></td>
                        <td><input type="text" class="form-control" id="site_name" ><td>
                      </tr>
                      <tr>
                        <td><label for="site_tagline">Site Tagline</label></td>
                        <td><input type="text" class="form-control" id="site_tagline"></td>
                      </tr>
                      <tr>
                        <td><label for="default_meta_title">Default Meta Title</label></td>
                        <td><input type="text" class="form-control" id="default_meta_title"></td>
                      </tr>
                      <tr>
                        <td><label for="default_meta_description">Default Meta
                        Description</label></td>
                        <td><textarea class="form-control" id="default_meta_description" rows="3"></textarea></td>
                      </tr>
                      <tr>
                        <td><label for="default_og_image">Default Graph Image</label></td>
                        <input type="hidden" class="form-control" id="hidden_og_image" >
                        <td><input type="file" class="form-control .default_og_image" id="default_og_image" >
                        <img id="previewImage" src="" alt="Image Preview" style="max-width: 200px; max-height:100px; ">
                        </td>
                      </tr>
                      <tr>
                        <td><label for="favicon">Favicon (URL)</label></td>
                        <td><input type="text" class="form-control" id="favicon" ></td>
                      </tr>
                      <tr>
                        <td><label for="google_analytics_id">Google Analytics ID</label></td>
                        <td><input type="text" class="form-control" id="google_analytics_id" ></td>
                      </tr>
                      <tr>
                        <td><label for="google_search_console">Google Search Console Verification Code</label></td>
                        <td><input type="text" class="form-control" id="google_search_console" ></td>
                      </tr>
                      <tr>
                        <td><label for="bing_webmaster">Bing Webmaster Verification Code</label></td>
                        <td><input type="text" class="form-control" id="bing_webmaster" ></td>
                      </tr>
                      <tr>
                        <td><label for="schema_organization">Schema Organization JSON-LD</label></td>
                        <td><textarea class="form-control" id="schema_organization" rows="5"></textarea></td>
                      </tr>
                    </table>
                    
                       <div class="alartdiv"  id='faildalert'>
                      </div>
                      
                    <button onclick="updateseo();" id='seoupdatebutton' type="submit">Save SEO Settings</button>
                </form>
              
              
            </div>
          </div>
        </div>
        </div>
        
  <!--   page seo model   -->
        <div class="modal fade" id="page_seo_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Add Page SEO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                    <table>
                      <tr>
                        <td><label for="site_name">Page URL</label></td>
                        <td><input type="text" class="form-control" id="page_url" placeholder="/about-us" ><td>
                      </tr>
                      <tr>
                        <td><label for="site_tagline">Meta title</label></td>
                        <td><input type="text" class="form-control" id="page_meta_title"></td>
                      </tr>
                      <tr>
                        <td><label for="page_meta_description">Meta description</label></td>
                        <td><textarea id='page_meta_description' class="form-control" rows="3"></textarea></td>
                      </tr>
                      <tr>
                        <td><label for="page_meta_keywords">Meta Keywords</label></td>
                        <td><textarea  class="form-control" id="page_meta_keywords" rows="3"></textarea></td>
                      </tr>
                      <tr>
                        <td><label for="page_og_image">OG Image (URL)</label></td>
                        <td><input type="file" id="page_og_image"  class="form-control ">
                          <img id="previewImage" src="" alt="Image Preview"
                          style="max-width: 200px; max-height:100px;
                          display:none;">
                        </td>
                      </tr>
                      <tr>
                        <td><label for="page_canonical_url">Canonical URL</label></td>
                        <td><input type="text"  id="page_canonical_url" class="form-control" placeholder="https://example.com/about-us" ></td>
                      </tr>
                      <tr>
                        <td><label for="page_robots_meta">Robots Meta</label></td>
                        <td>
                          <select id='page_robots_meta' class="form-control">
                            <option value="index, follow">index, follow</option>
                            <option value="noindex, follow">noindex, follow</option>
                            <option value="index, nofollow">index, nofollow</option>
                            <option value="noindex, nofollow">noindex, nofollow</option>
                          </select>
                        </td>
                      </tr>
                    </table>
                      <div class="alartdiv"  id='pagefaildalert'>
                      </div>
                    <button onclick="pageseoinsert();" id='pageSEOInsertButton' type="submit">Save SEO Settings</button>
              
              
            </div>
          </div>
        </div>
        </div>
        
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <script>
      function updateseo(){
        let site_name = document.getElementById('site_name').value;
        let site_tagline = document.getElementById('site_tagline').value;
        let default_meta_title = document.getElementById('default_meta_title').value;
        let default_meta_description = document.getElementById('default_meta_description').value;
       // let default_og_image = document.getElementById('default_og_image').value;
        let hidden_og_image = document.getElementById('hidden_og_image').value;
        let favicon = document.getElementById('favicon').value;
        let google_analytics_id = document.getElementById('google_analytics_id').value;
        let google_search_console = document.getElementById('google_search_console').value;
        let bing_webmaster = document.getElementById('bing_webmaster').value;
        let schema_organization = document.getElementById('schema_organization').value;
        
        let default_og_image = document.getElementById('default_og_image');
        
        
        
        let seoupdatebutton = document.getElementById('seoupdatebutton');
        
        seoupdatebutton.disabled=true
        seoupdatebutton.innerHTML=`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        
         let formData = new FormData();
            
            
             if ( default_og_image.files.length > 0 ) {
                    formData.append('default_og_image', default_og_image.files[0]);
                }
            
            
            
            
            formData.append('site_name', site_name);
            formData.append('site_tagline', site_tagline);
            formData.append('default_meta_title', default_meta_title);
            formData.append('default_meta_description', default_meta_description);
           // formData.append('default_og_image', $('#default_og_image')[0].files[0]);
            formData.append('hidden_og_image', hidden_og_image);
            formData.append('favicon', favicon);
            formData.append('google_analytics_id', google_analytics_id);
            formData.append('google_search_console', google_search_console);
            formData.append('bing_webmaster', bing_webmaster);
            formData.append('schema_organization', schema_organization);
        
        
        
          $.ajax({
            url : '/admin/update_seo',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
             /* $('#site_name').val('');
              $('#site_tagline').val('');
              $('#default_meta_title').val('');
              $('#default_meta_description').val('');
              $('#default_og_image').val('');
              $('#favicon').val('');
              $('#google_analytics_id').val('');
              $('#google_search_console').val('');
              $('#bing_webmaster').val('');
              $('#schema_organization').val('');
              */
              
              seoupdatebutton.disabled=false;
              seoupdatebutton.innerHTML=`
                Save SEO Settings
              `;
          
              var modal = bootstrap.Modal.getInstance($('#name')[0]);
              modal.hide();
             // categoryFetch();
             
             fetch_seo();
              showalert( ' Default SEO date update successful' , '#ffffff', 'faildalert' );
            },
            error:function(xhr,status,error){
              //alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                seoupdatebutton.disabled=false;
                seoupdatebutton.innerHTML=`
                  Save SEO Settings
                `;
                
                showalert( response.errors , '#ffffff', 'faildalert' );
                
                
                /*Inputerrors.innerHTML = response.message;
                Inputerror.innerHTML = response.errors;
                Inputerror.style.color='red';
                Inputerrors.style.color='red';*/
                console.log(xhr.responseText);
            }
          });
      }
      
      
      function fetch_seo(){
          $.ajax({
            url : '/admin/fetch_seo',
            type :'POST',
            processData: false,
            contentType: false,
           // data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
              $('#site_name').val(response.seo_settings.site_name);
              $('#site_tagline').val(response.seo_settings.site_tagline);
              $('#default_meta_title').val(response.seo_settings.default_meta_title);
              $('#default_meta_description').val(response.seo_settings.default_meta_description);
              $('#hidden_og_image').val(response.seo_settings.default_og_image);
              $('#favicon').val(response.seo_settings.favicon);
              $('#google_analytics_id').val(response.seo_settings.google_analytics_id);
              $('#google_search_console').val(response.seo_settings.google_search_console);
              $('#bing_webmaster').val(response.seo_settings.bing_webmaster);
              $('#schema_organization').val(response.seo_settings.schema_organization);
              
              $('previewImage').src = `/storage/${response.seo_settings.default_og_image}`;
              
              let show_seodata = document.getElementById('show_seodata');
            
              show_seodata.innerHTML=`
                <tr>
                  <td>${response.seo_settings.id}</td>
                  <td>${response.seo_settings.site_name}</td>
                  <td>${response.seo_settings.site_tagline}</td>
                  <td>${response.seo_settings.default_meta_title}</td>
                  <td>${response.seo_settings.default_meta_description}</td>
                  <td><img src='/storage/${response.seo_settings.default_og_image}'</td>
                  <td>${response.seo_settings.favicon}</td>
                  <td>${response.seo_settings.google_analytics_id}</td>
                  <td>${response.seo_settings.bing_webmaster}</td>
                  <td>${response.seo_settings.bing_webmaster}</td>
                  <td>${response.seo_settings.schema_organization}</td>
                </tr>`;
              
            },
            
            error:function(xhr,status,error){
              //alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                /*Inputerrors.innerHTML = response.message;
                Inputerror.innerHTML = response.errors;
                Inputerror.style.color='red';
                Inputerrors.style.color='red';*/
                console.log(xhr.responseText);
            }
          });
      }
      fetch_seo();
      
      
      // page seo insert 
      
      function pageseoinsert(){
        let page_url = document.getElementById('page_url').value;
        let page_meta_title = document.getElementById('page_meta_title').value;
        let page_meta_description = document.getElementById('page_meta_description').value;
        let page_meta_keywords = document.getElementById('page_meta_keywords').value;
        let page_og_image = document.getElementById('page_og_image').value;
        let page_canonical_url = document.getElementById('page_canonical_url').value;
        let page_robots_meta = document.getElementById('page_robots_meta').value;
        
        
        let pageSEOInsertButton = document.getElementById('pageSEOInsertButton');
        
        pageSEOInsertButton.disabled=true
        pageSEOInsertButton.innerHTML=`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        
         let formData = new FormData();
              
            formData.append('page_url', page_url);
            formData.append('page_meta_title', page_meta_title);
            formData.append('page_meta_description', page_meta_description);
            formData.append('page_meta_keywords', page_meta_keywords);
            formData.append('page_og_image',  $('#page_og_image')[0].files[0]);
            formData.append('page_canonical_url', page_canonical_url);
            formData.append('page_robots_meta', page_robots_meta);
        
        
        
          $.ajax({
            url : '/admin/pageSEOinsert',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
             
             
              pageSEOInsertButton.disabled=false;
              pageSEOInsertButton.innerHTML=`
                Save SEO Settings
              `;
          
              var modal = bootstrap.Modal.getInstance($('#page_seo_model')[0]);
              modal.hide();
             // categoryFetch();
             
             page_fetch_seo();
             
               showalert( 'Insert successfull', '#ffffff', 'pageSuccessfullalert' );
             
            },
            error:function(xhr,status,error){
              //alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                pageSEOInsertButton.disabled=false;
                pageSEOInsertButton.innerHTML=`
                  Save SEO Settings
                `;
                
                /*Inputerrors.innerHTML = response.message;
                Inputerror.innerHTML = response.errors;
                Inputerror.style.color='red';
                Inputerrors.style.color='red';*/
                console.log(xhr.responseText);
                showalert( response.errors , '#ffffff', 'pagefaildalert' );
            }
          });
      }
      
      function page_fetch_seo(){
        $('.editor-modal').remove(); 
          $.ajax({
            url : '/admin/page_fetch_seo',
            type :'POST',
            processData: false,
            contentType: false,
           // data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
             $('#page_show_seodata').html('');
              $.each(response.page_seo_settings, function(index, seo_setting) {
                
                let editeId = `edite${index}`;
                let DelmodalId = `DelModal${seo_setting.id}`;
                
                $('#page_show_seodata').append(`
                  <tr>
                    <td>${seo_setting.id}</td>
                    <td>${seo_setting.page_url}</td>
                    <td>${seo_setting.meta_title}</td>
                    <td>${seo_setting.meta_description}</td>
                    <td>${seo_setting.meta_keywords}</td>
                    <td><img src='/storage/${seo_setting.og_image}'></td>
                    <td>${seo_setting.canonical_url}</td>
                    <td>${seo_setting.robots_meta}</td>
                    <td>
                      <button type="button" class="buttontext" data-bs-toggle="modal" data-bs-target="#${editeId}"><i class="bi bi-pencil-square"></i></button>
                      <button type="button" class="buttontext" data-bs-toggle="modal" data-bs-target="#${DelmodalId}"> <i class="bi  bi-trash"></i> </button>
                    </td>
                  </tr>
                `);
                  
                  
                $('body').append(`
                 
                  <div class="modal fade editor-modal  editeModel" id="${editeId}" tabindex="-1" aria-labelledby="${editeId}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5"
                          id="${editeId}Label">edite this page seo </h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                        
                          <table>
                            <tr>
                              <td><label for="site_name">Page URL</label></td>
                              <td><input type="text" class="form-control" id="page_url_${seo_setting.id}" value="${seo_setting.page_url}"
                              placeholder="/about-us" ></td>
                            </tr>
                            <tr>
                              <td><label for="site_tagline">Meta title</label></td>
                              <td><input type="text" value="${seo_setting.meta_title}" class="form-control" id="page_meta_title_${seo_setting.id}"></td>
                            </tr>
                            <tr>
                              <td><label for="page_meta_description">Meta description</label></td>
                              <td><textarea id='page_meta_description_${seo_setting.id}' class="form-control" rows="3">${seo_setting.meta_description}</textarea></td>
                            </tr>
                            <tr>
                              <td><label for="page_meta_keywords">Meta Keywords</label></td>
                              <td><textarea  class="form-control" id="page_meta_keywords_${seo_setting.id}" rows="3">${seo_setting.meta_keywords}</textarea></td>
                            </tr>
                            <tr>
                              <td><label for="page_og_image">OG Image (URL)</label></td>
                              <td><input type="file" id="page_og_image_${seo_setting.id}"  class="form-control ">
                                <input type='hidden' id='old_page_og_image_${seo_setting.id}' value='${seo_setting.og_image}'>
                                <img id="previewImage_${seo_setting.id}" src="/storage/${seo_setting.og_image}" alt="Image Preview" style="max-width: 200px; max-height:100px; ">
                              </td>
                            </tr>
                            <tr>
                              <td><label for="page_canonical_url">Canonical URL</label></td>
                              <td><input type="text" value="${seo_setting.canonical_url}"  id="page_canonical_url_${seo_setting.id}" class="form-control" placeholder="https://example.com/about-us" ></td>
                            </tr>
                            <tr>
                              <td><label for="page_robots_meta">Robots Meta</label></td>
                              <td>
                                <select id='page_robots_meta_${seo_setting.id}' class="form-control">
                                  <option ${ seo_setting.robots_meta === "index, follow" ? 'selected' : '' }  value="index, follow">index, follow</option>
                                  <option ${ seo_setting.robots_meta ===  "noindex, follow" ? 'selected' : '' } value="noindex,follow">noindex, follow</option>
                                  <option ${ seo_setting.robots_meta ===  "index, nofollow" ? 'selected' : '' } value="index, nofollow">index, nofollow</option>
                                  <option ${ seo_setting.robots_meta ===  "noindex, nofollow" ? 'selected' : '' } value="noindex, nofollow">noindex, nofollow</option>
                                </select>
                              </td>
                            </tr>
                          </table>
                        </div>
                        
                        
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" onclick="editpageseo( '${seo_setting.id}' );" id='EditeSaveButton_${seo_setting.id}' class="btn btn-primary editebutton">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                
                  
                  <div class="modal fade deleteModel editor-modal" id="${DelmodalId}" tabindex="-1" aria-labelledby="${DelmodalId}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5 animate-border"  style='margin:auto;  padding:  0px, 6px , 0px , 6px ; border-radius:50%; '  id="${DelmodalId}Label"><i style='font-size:50px;' class='bi bi-trash'  ></i></h1>
                        </div>
                        <div class="modal-body">
                          <input type='hidden' id='deleteId_${seo_setting.id}' value='${seo_setting.id}'>
                          <h4>Are you sure you want to delete this category?</h4>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" id="deletebutton_${seo_setting.id}" onclick="deletepageseo( '${seo_setting.id}' );"class="btn btn-danger deletebutton${seo_setting.id}">delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                `);
     
              });
              
              
            },
            
            error:function(xhr,status,error){
              //alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                /*Inputerrors.innerHTML = response.message;
                Inputerror.innerHTML = response.errors;
                Inputerror.style.color='red';
                Inputerrors.style.color='red';*/
                console.log(xhr.responseText);
            }
          });
      } 
      page_fetch_seo();
      
      
      // edite page seo setting
      
      function editpageseo( id ){
        let page_url = document.getElementById('page_url_'+id).value;
        let page_meta_title = document.getElementById('page_meta_title_'+id).value;
        let page_meta_description = document.getElementById('page_meta_description_'+id).value;
        let page_meta_keywords = document.getElementById('page_meta_keywords_'+id).value;
        let old_page_og_image = document.getElementById('old_page_og_image_'+id).value;
        let page_og_image = document.getElementById('page_og_image_'+id);
        let page_canonical_url = document.getElementById('page_canonical_url_'+id).value;
        let page_robots_meta = document.getElementById('page_robots_meta_'+id).value;
      
   
        let EditeSaveButton = document.getElementById('EditeSaveButton_'+id);
        
      
        
        EditeSaveButton.disabled=true
        EditeSaveButton.innerHTML=`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        
         let formData = new FormData();
            
            if ( page_og_image.files.length > 0 ) {
              formData.append('edit_page_og_image', page_og_image.files[0]);
            }
            
            
            formData.append('id', id);
            formData.append('page_url', page_url);
            formData.append('page_meta_title', page_meta_title);
            formData.append('page_meta_description', page_meta_description);
            formData.append('page_meta_keywords', page_meta_keywords);
            formData.append('old_page_og_image', old_page_og_image);
            //formData.append('edit_page_og_image', page_og_image );
            formData.append('page_canonical_url', page_canonical_url);
            formData.append('page_robots_meta', page_robots_meta);
            
        
   
        
          $.ajax({
            url : '/admin/editpageSEOinsert',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
             
             
              EditeSaveButton.disabled=false;
              EditeSaveButton.innerHTML=`
                Save changes
              `;
          
              var modal = bootstrap.Modal.getInstance(document.querySelector('.editeModel.show'));
               modal.hide();
             // categoryFetch();
             
             page_fetch_seo();
             
               showalert( 'update  successfull', '#ffffff', 'pageSuccessfullalert' );
             
            },
            error:function(xhr,status,error){
              //alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                EditeSaveButton.disabled=false;
                EditeSaveButton.innerHTML=`
                  Save changes
                `;
                
                alert(xhr.responseText);
                
                /*Inputerrors.innerHTML = response.message;
                Inputerror.innerHTML = response.errors;
                Inputerror.style.color='red';
                Inputerrors.style.color='red';*/
                console.log(xhr.responseText);
                showalert( response.errors , '#ffffff', 'pagefaildalert' );
            }
          });
      }
      
      //delete page seo
      
      function deletepageseo( deleteid  ){
        
        
        let deletebutton = document.getElementById('deletebutton_'+deleteid);
        
        deletebutton.disabled=true
        deletebutton.innerHTML=`
          <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
          <span role="status">Loading...</span>
        `;
        
         let formData = new FormData();
         
          formData.append('deleteid', deleteid);
      
          $.ajax({
            url : '/admin/deletepageSEO',
            type :'POST',
            processData: false,
            contentType: false,
            data: formData,
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success:function(response){
            
              deletebutton.disabled=false;
              deletebutton.innerHTML=`
                delete
              `;
          
              var modal = bootstrap.Modal.getInstance(document.querySelector('.deleteModel.show'));
               modal.hide();
             // categoryFetch();
             
             page_fetch_seo();
             
               showalert( 'page seo delete successfull', '#ffffff', 'pageSuccessfullalert' );
             
            },
            error:function(xhr,status,error){
              //alert ('Error:'+ xhr.responseText);
                const response = JSON.parse(xhr.responseText);
                deletebutton.disabled=false;
                deletebutton.innerHTML=`
                  delete
                `;
                
               // alert(xhr.responseText);
                
                /*Inputerrors.innerHTML = response.message;
                Inputerror.innerHTML = response.errors;
                Inputerror.style.color='red';
                Inputerrors.style.color='red';*/
                console.log(xhr.responseText);
                showalert( response.errors , '#ffffff', 'pagefaildalert' );
            }
          });
        
      }
    </script>
    <script>
      function showalert( alert, color, id ){
        const Inputerror =document.getElementById(id);
        Inputerror.style.display = 'block';
        Inputerror.innerHTML=`
        </style>
          <div id="alert" style='color:${color};'>
            ${alert}
          </div>
        `;
        setTimeout(() => {
          Inputerror.style.display = 'none';
        }, 3000);
      }
    </script>
    <script>
      document.getElementById('default_og_image').addEventListener('change', function(event) {
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
  </script>
  </body>
</html>