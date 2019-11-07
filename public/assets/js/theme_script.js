$(document).ready(function () {
    $('.parent-image-container').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image'
        // other options
    });

    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: base_url+'/calender_data',
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        dayClick: function(date, jsEvent, view) {
            $('#event_modal').modal('show');
            var date_put=date.format('YYYY-MM-DD');
            var time_put=date.format('HH:mm:ss');
            $('#event_date').val(date_put);
            $('#event_time').val(time_put);

        },
        /*select: function (start, end, allDay) {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

            var title = prompt('Event Title:');
            var name = prompt('Name:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                {
                    title: title,
                    start: start,
                    end: end,
                    allDay: allDay
                },
                true
                );
            }
            calendar.fullCalendar('unselect');
        },*/
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: 'edit-event.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function (response) {
                    displayMessage("Updated Successfully");
                }
            });
        },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to Edit?");
            if (deleteMsg) {
                window.location.href=base_url+'/my-event-edit/'+event.id;
            }
        }

    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });
    $('.timepicker').timepicker({
        minuteStep: 5,
        showSeconds: false,
        showMeridian: false,
        defaultTime: false,
        icons:{
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'glyphicon glyphicon-chevron-left',
            next: 'glyphicon glyphicon-chevron-right',
            today: 'glyphicon glyphicon-screenshot',
            clear: 'glyphicon glyphicon-trash',
            close: 'glyphicon glyphicon-remove'
        }
    });

    $('body').on('submit', '.event_form', function(e) {
        e.preventDefault();
        var frm = $(this);
        var gallery_image_count= $('#event_gallery_image')[0].files;
        //console.log(gallery_image_count.length); return;
        if(gallery_image_count.length>4){
            alert('You can select only 4 files!');
            $('#event_gallery_image').focus();
            $('#event_gallery_image').css("border", "1px solid red"); 
            return false;

        } else{
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                dataType: "json",
                data: frm.serialize(),
                success: function(result){
                    $('#event_modal').modal('toggle');
                 if(result.status=='true'){
                    console.log(result);
                    displayMessage("Event added Successfully! But need to Approve by the Admin to display!");
                    calendar.fullCalendar('unselect');
                    setInterval(function() { location.reload(); }, 5000);
                 } else{
                    displayMessage("Please try again later!");
                 }

                },
                error: function(result){
                 //console.log(result);
                }
            });
        }

    });
    $('body').on('change', '#service_type', function (e) {
        e.preventDefault();
        var this_element=$(this);
        var type=this_element.val();
        var user_id=this_element.attr('users_id');
        //alert(user_id);
        //alert(this_element.val());
        $.ajax({
            type: 'post',
            url: base_url +'/get_service_list_ajax',
            dataType: "json",
            data: { "_token": $('meta[name="csrf-token"]').attr('content'), "type": type, "user_id": user_id},
            success: function (result) {
                console.log(result.html);
                if (result.status == 'true') {
                    $('.services_drop_create').html(result.html);
                } 

            },
            error: function (result) {
                //console.log(result);
            }
        });
    });
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose:true,
        });
    });
    $('body').on('click', '.vendor_details_company_btn', function (e) {
        e.preventDefault();
        var this_element=$(this);
        var id=this_element.attr('company_id');
        $('#company_details').modal('toggle');
        $.ajax({
            url: base_url +'/get_vendor_company_details',
            type: 'post',
            data: { "_token": $('meta[name="csrf-token"]').attr('content'), 'id': id },
            dataType: 'json',
            success: function(result){
                if (result.status == 'true') {
                    $('#model_body_content').html(result.html);
                } 
            },
            error: function (result) {
                console.log(result);
            }
        });
    });

    $('body').on('click', '#add_to_calender', function (e) {
        
        var this_element=$(this);
        var event_id=this_element.attr('event_id');
        if(this_element.attr('data_status')!='1'){
            e.preventDefault();
            $.ajax({
                url: base_url+"/login_check",
                type: 'post',
                data: { "_token": $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',

            }).done(function (res) {
                if(res.login=='true'){
                    $.ajax({
                        url: base_url+"/add_event_ajax",
                        type: 'post',
                        data: { "_token": $('meta[name="csrf-token"]').attr('content'), event_id: event_id },
                        dataType: 'json',

                    }).done(function(res1){
                        if(res1.status=='true'){
                            $('#success_popup').modal('toggle');
                            $('.responce_msg').html(res1.msg);
                            this_element.text('View calender');
                            this_element.attr('href',base_url+'/event-calender');
                            this_element.attr('data_status','1');
                        } else{
                            $('#error_popup').modal('toggle');
                            $('.responce_msg').html(res1.msg);
                        }
                    });
                } else {
                    $('#popup_current_url').val(window.location.href);
                    $('#login_popup').modal('toggle');
                }
            });

        } else{
            this_element.attr('href',base_url+'/event-calender');
            this_element.attr('data_status','1');
            location.reload(this_element.attr('href')); 
        }
    });
    $('body').on('click', '#popup_login_btn', function (e) {
        e.preventDefault();
        var this_element=$(this);
        if($('#popup_login_email').val()!='' && $('#popup_login_password').val()!=''){
            var email=$('#popup_login_email').val();
            var password=$('#popup_login_password').val();
            $.ajax({
                url: base_url+"/popup_login",
                type: 'post',
                data: { "_token": $('meta[name="csrf-token"]').attr('content'),password:password,email:email },
                dataType: 'json',

            }).done(function (res) {
                if(res.status=='true'){
                    location.reload($('#popup_current_url').val()); 
                } else{
                    $('#popup_login_message').html('<div class="alert alert-danger" role="alert">'+
                    'Username or Password wrong!</div>');
                }
            });
        } else {
            $('#popup_login_message').html('<div class="alert alert-danger" role="alert">'+
            'Please fill all the field!</div>');
        }
    });

/*for breadcrum*/


});
Dropzone.options.myDropzone= {
    url: base_url+'/ajax_image_upload',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 1,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("submit-all").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("type", 'event_image_gallery');
            //formData.append("lastname", jQuery("#lastname").val());
        });
    }
}
function displayMessage(message) {
   $(".response").html("<div class='alert alert-success'>"+message+"</div>");
   setInterval(function() { $(".success").fadeOut(); }, 5000);
}
$(function() {
    $('.event_box').matchHeight();
});