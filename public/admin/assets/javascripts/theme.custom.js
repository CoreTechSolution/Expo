/* Add here all your JS customizations */
function convertToSlug(Text) {
    return Text
    .toLowerCase()
    .replace(/ /g, '-')
    .replace(/[^\w-]+/g, '')
    .replace(/[^a-zA-Z0-9]+/g, '-')
    ;
}
$(document).ready(function(){
  $('body').on('keyup', '#event_verticals_name', function (e) {
        var title_text = $(this).val();
        var slug_text = convertToSlug(title_text);
        $('#slug').val(slug_text);
    });
      $('body').on('keyup', '#vendor_category_name', function (e) {
        var title_text = $(this).val();
        var slug_text = convertToSlug(title_text);
        $('#slug').val(slug_text);
    });
    $('body').on('keyup', '#city_name', function (e) {
        var title_text = $(this).val();
        var slug_text = convertToSlug(title_text);
        $('#slug').val(slug_text);
    });
    $('body').on('keyup', '#event_title', function (e) {
        var title_text = $(this).val();
        var slug_text = convertToSlug(title_text);
        $('#slug').val(slug_text);
    });
    $('body').on('keyup', '#type_name', function (e) {
        var title_text = $(this).val();
        var slug_text = convertToSlug(title_text);
        $('#slug').val(slug_text);
    });
    $('body').on('change', '.toggle_switch_checkbox', function (e) {
        var this_element=$(this);
        if(this_element. prop("checked") == true){

        }

    });
    $('body').on('click', '.remove_img_block', function (e) {
        var this_element = $(this);
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    //alert($('meta[name="csrf-token"]').attr('content'));

                    
                    var remove_element_id = this_element.attr('data-id');
                    $('#remove_element_row' + remove_element_id).html('');
                    swal('Deleted!');
                   

                });
            },
            allowOutsideClick: false
        });


        
        
    });
    $('body').on('click', '.add_gallery_image_a', function (e) {
        var this_element=$(this);
        var element_id = this_element.attr('data-id');
        var counter = parseInt(element_id)+1;
        var html='';
        html = $('#dynamic_image_gallery_field').html();
        html += '<div class="form-group">'+
            '<div class="col-sm-2" ></div>'+
                '<div class="col-sm-4">'+
                    '<div class="input-group">'+
                        '<span class="input-group-btn">'+
            '<a id="gallaryimage' + counter + '" data-input="gallerypath' + counter +'" style="width:100px;" data-preview="galleryholder' + counter +'" class="btn btn-primary">'+
                                '<i class="fa fa-picture-o"></i> Choose</a>'+
                        '</span>'+
            '<input id="gallerypath' + counter +'" class="form-control" type="text" name="company_gallery_image[]" value="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-sm-4">'+
                        '<div class="edit_img_preview" style="margin:5px 0;">'+
                            '<img id="galleryholder' + counter +'" src="" alt="" style="width: 250px;">'+
                        '</div>'+
                        '</div>'+
                    '</div>';
        $('#dynamic_image_gallery_field').html(html);
        this_element.attr('data-id', counter);
        $('[id^=gallaryimage]').filemanager('file', { prefix: route_prefix });
        
    });
    $('body').on('click', '.add_vendor_img_block', function (e) {
        var this_element = $(this);
        var div_count_id=this_element.attr('data-id');
        div_count_id = (parseInt(div_count_id) + 1);
        //var html = $('#vendor_img_add_div').html();
        var html='';
        html += '<div id="vondor_image_block' + div_count_id + '">' +
            '<div class="row">' +
            '<div class="col-sm-4">' +
            '<div class="input-group">' +
            '<span class="input-group-btn" >' +
            '<a id="image_gallery' + div_count_id + '" class="btn btn-primary" data-input="image_gallery_thumb' + div_count_id + '" style="width:100px;" data-preview="image_gallery_holder' + div_count_id + '" class="btn btn-primary">' +
            '<i class="fa fa-picture-o"></i> Choose' +
            '</a>' +
            '</span>' +
            '<input id="image_gallery_thumb' + div_count_id + '" class="form-control" type="text" name="company_gallery_image[]" >' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-4">' +
            '<div class="edit_img_preview">' +
            '<img id="image_gallery_thumb' + div_count_id + '" alt="" style="width: 250px;">' +
            '</div>' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<a href="javascript:void(0);" class="remove_vendor_img_block">Remove</a>' +
            '</div>' +
            '</div>' +
            '</div>';
        $('#vendor_img_add_div').append(html);
        this_element.attr('data-id', div_count_id);
        alert(div_count_id);
    });

    $('body').on('click', '#event_edit_add_time', function (e) {
        var this_element = $(this);
        if ($('#event_date_start').val().length !== 0 && $('#event_date_end').val()!==0 ){
            var date1 = new Date($('#event_date_start').val());
            var date2 = new Date($('#event_date_end').val());
            // To calculate the time difference of two dates
            var Difference_In_Time = date2.getTime() - date1.getTime();

            // To calculate the no. of days between two dates
            var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
            var html='';
            //alert(Difference_In_Days);
            if(Difference_In_Days>0){
                var running_date = new Date();
                for (var i = 0; i <= Difference_In_Days; i++) {
                    if(i==0){
                        html += '<div class="form-group row1">' +
                            '<div class="row" id="row1">' +
                            '<div class="show_time_date">' +
                            '<span>' + jQueryDateFormat(date1) + '</span>' +
                            '</div>' +
                            '<div class="enter_time_one">' +
                            '<input type="text" class="form-control timepicker" id="time' + i + '" name="event_time_start1[]" >' +
                            '</div>' +
                            '<div class="enter_time_text">' +
                            '' +
                            '</div>' +
                            '<div class="enter_time_to">' +
                            '<input type="text" class="form-control datepicker" id="date1" name="event_date_start1[]" value="' + jQueryDateFormat(date1) +'" readonly>' +
                            '</div>' +
                            '</div>' +
                            '</div >';
                        running_date=date1;
                    } else{
                        html += '<div class="form-group row1">' +
                            '<div class="row" id="row1">' +
                            '<div class="show_time_date">' +
                            '<span>' + jQueryDateFormat(running_date) + '</span>' +
                            '</div>' +
                            '<div class="enter_time_one">' +
                            '<input type="text" class="form-control timepicker" id="time' + i + '" name="event_time_start1[]">' +
                            '</div>' +
                            '<div class="enter_time_text">' +
                            '' +
                            '</div>' +
                            '<div class="enter_time_to">' +
                            '<input type="text" class="form-control datepicker" id="date1" name="event_date_start1[]" value="' + jQueryDateFormat(running_date) + '" readonly>' +
                            '</div>' +
                            '</div>' +
                            '</div >';
                    }
                    running_date.setDate(running_date.getDate() + 1);
                }
            } else{
                html += '<div class="form-group row1">' +
                    '<div class="row" id="row1">' +
                    '<div class="show_time_date">' +
                    '<span>' + jQueryDateFormat(date1) + '</span>' +
                    '</div>' +
                    '<div class="enter_time_one">' +
                    '<input type="text" class="form-control timepicker" id="time' + i + '" name="event_time_start1[]" readonly>' +
                    '</div>' +
                    '<div class="enter_time_text">' +
                    '' +
                    '</div>' +
                    '<div class="enter_time_to">' +
                    '<input type="text" class="form-control datepicker" id="date1" name="event_date_start1[]" value="' + jQueryDateFormat(date1) + '" readonly>' +
                    '</div>' +
                    '</div>' +
                    '</div >';
            }
            $('#event_edit_add_time_html').html(html);
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
            });
            $('.timepicker').timepicker({
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false,
                defaultTime: false,

            });

        } else{
            alert('please enter event date first! ');
        }


    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('.timepicker').timepicker({
        minuteStep: 5,
        showSeconds: false,
        showMeridian: false,
        defaultTime: false,

    });

    $('#attendees_list_show').select2({
        multiple: true,
        placeholder: "Choose",
    });
    var value = $('#attendees_list_show').val();
    if (value != null) {
        $("#attendees_list_show").val(value).trigger('change');
    }

  

    $('#exhibitors_list_show').select2({
        multiple: true,
        placeholder: "Choose",
    });
    var value = $('#exhibitors_list_show').val();
    if (value != null) {
        $("#exhibitors_list_show").val(value).trigger('change');
    }




    $('#sponsor_list_show1').select2({
        multiple: true,
        placeholder: "Choose",
    });
    var value = $('#sponsor_list_show1').val();
    if (value != null) {
        $("#sponsor_list_show1").val(value).trigger('change');
    }

    $('#attendee_list_show1').select2({
        multiple: true,
        placeholder: "Choose",
    });
    var value = $('#attendee_list_show1').val();
    if (value != null) {
        $("#attendee_list_show1").val(value).trigger('change');
    }

    $('#speaker_list_show1').select2({
        multiple: true,
        placeholder: "Choose",
    });
    var value = $('#speaker_list_show1').val();
    if (value != null) {
        $("#speaker_list_show1").val(value).trigger('change');
    }

    $('#exhibitor_list_show1').select2({
        multiple: true,
        placeholder: "Choose",
    });
    var value = $('#exhibitor_list_show1').val();
    if (value != null) {
        $("#exhibitor_list_show1").val(value).trigger('change');
    }

    
});
function delete_data(id, check_field, table_name) {
    var current_location = window.location.href;
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function (resolve) {
                //alert($('meta[name="csrf-token"]').attr('content'));
                $.ajax({
                    url: "delete_product",
                    type: 'post',
                    data: { "_token": $('meta[name="csrf-token"]').attr('content'), id: id, check_field: check_field, table_name: table_name},
                    dataType: 'json'

                })
                .done(function (response) {
                    swal('Deleted!', response.message, response.status);
                    window.location.href = current_location;
                    window.location.reload();
                    //readProducts();
                })
                .fail(function () {
                    swal('Oops...', 'Something went wrong with delete function !', 'error');
                });

            });
        },
        allowOutsideClick: false
    });
}
function jQueryDateFormat(dateObject,format='yyyy-mm-dd',separator='-') {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    if(format=='yyyy-mm-dd')
        var date = year + separator + month + separator + day ;
    if (format == 'mm-dd-yyyy')
        var date = month + separator + day + separator + year;
    if (format == 'dd-mm-yyyy')
        var date = day + separator + month + separator + year;

    return date;
};