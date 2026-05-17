window.notificationIndex = function(){
    fetchDataAjax('/notification/index','post','notificationIndexData','Nan');
}
notificationIndex();

window.notificationIndexData = function( response ){
    $('#notificationContainer').html('');

     let notificationCount = document.getElementById('notificationCount');


    let count = 0;



    $.each(response.notification, function(index, notificationRow) {


        count ++;

        $('#notificationContainer').append(`
            <li class="notification unread" style='display:flex; align-items:flex-start; gap:10px;'>
                <div class="notif-icon">
                    <i class="bi bi-bell-fill"></i>
                </div>
                <div class="notif-content">
                    <strong>${notificationRow.title}</strong>
                    <p>${notificationRow.created_at}</p>
                </div>
            </li><br>

        `);
            notificationCount.innerHTML = count;


    })
}
