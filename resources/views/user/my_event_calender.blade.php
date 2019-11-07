@extends('layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('template-part.sidebar')

            </div>
            <div class="col-lg-9">
                <div class="dash_page_container">
                   <div class="dash_page_heading">
                    {{ $data['page_title'] }}
                </div>
                <div class="dash_page_body">

                    @if(!empty($errors->all()))
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if ($alert = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $alert }}
                    </div>
                    @endif
                    <div class="alert alert-info">
                        <div class="small_box yellow_box"></div><span>Not approve</span>
                        <div class="small_box green_box"></div><span>Approve</span>
                        <!-- <div class="small_box green_box"></div><span>Event passed</span> -->
                        <div class="small_box red_box"></div><span>Canceled</span>
                    </div>
                    
                    <div class="response"></div>
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<!-- Modal for adding event to calender -->
<div class="modal fade" id="event_modal" role="dialog">
  <div class="modal-dialog">
     <!-- Modal content-->
     <div class="modal-content" style="width: 700px;">
        <div class="modal-header" style="">
            Add Event
            <button type="button" class="close" data-dismiss="modal">
                &times;
            </button>

        </div>
        <div class="modal-body" style="padding:40px 50px;">
            {{ Form::open(array(
                'url' => url('calender_data_add'),
                'method' => 'post',
                'class' => 'form',  
                'files' => true
                )) }}
            <input type="hidden" name="user_id" value="{{ $data['user']->id }}">
            <div id="modal_dynamic_form_input">
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="event_date_start">Start Date</label>
                            <input type="text" class="form-control datepicker" name="event_date_start" id="event_date_start">
                        </div>
                        <div class="col-lg-6">
                            <label for="event_date_end">End Date</label>
                            <input type="text" class="form-control datepicker" name="event_date_end" id="event_date_end">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="event_time_start">Start Time</label>
                            <input type="text" class="form-control timepicker" name="event_time_start" id="event_time_start">
                        </div>
                        <div class="col-lg-6">
                            <label for="event_time_end">End Time</label>
                            <input type="text" class="form-control timepicker" name="event_time_end" id="event_time_end">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="event_title"><span class="glyphicon glyphicon-user"></span> Title </label>
                    <input type="text" class="form-control" name="event_title" id="event_title">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="event_vertical_id">Event Verticals <span class="required">*</span></label>
                            
                                {{ Form::select('event_vertical_id', $data['event_verticals'] , '',array('placeholder'=>'Choose','id'=>'event_vertical_id','class'=>'form-control')) }}
                        </div>
                        <div class="col-lg-6">
                            <label for="event_vertical_id">Event Type <span class="required">*</span></label>
                            
                                {{ Form::select('event_type', $data['event_types'] , '',array('placeholder'=>'Choose','id'=>'event_type','class'=>'form-control')) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="event_headline"><span class="glyphicon glyphicon-user"></span> Headline <span class="label_small">(max. 100 character)</span></label>
                    <input type="text" class="form-control" name="event_headline" id="event_headline" max="100">
                </div>
                <div class="form-group">
                    <label for="event_description"><span class="glyphicon glyphicon-user"></span> Description <span class="label_small">(max. 500 character)</span></label>
                    <textarea class="form-control" name="event_description" id="event_description" max="500"></textarea>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="event_location">Location</label>
                            <input type="text" class="form-control" name="event_location" id="event_location">
                        </div>
                        <div class="col-lg-4">
                            <label for="event_country">Country</label>
                            <input type="text" class="form-control" name="event_country" id="event_country">
                        </div>
                        <div class="col-lg-4">
                            <label for="event_city">City</label>
                            <input type="text" class="form-control" name="event_city" id="event_city">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="attendees">Attendees</label>
                            <input type="number" class="form-control" name="attendees" id="attendees">
                        </div>
                        <div class="col-lg-6">
                            <label for="exhibitors">Exhibitors</label>
                            <input type="number" class="form-control" name="exhibitors" id="exhibitors">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="event_image">Featured Image</label>
                            <input type="file" class="" name="event_image" id="event_image" accept="image/*">
                        </div>
                        <div class="col-lg-6">
                            <!-- <div class="dropzone" id="my-dropzone" name="mainFileUploader">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </div>
                                <a href="#" id="submit-all"> upload </a> -->
                            <label for="event_gallery_image">Image Gallery</label>
                            <input type="file" class="" name="event_gallery_image[]" id="event_gallery_image" accept="image/*" multiple >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="event_image">Doc Upload</label>
                            <input type="file" class="" name="pdf_doc_upload" id="pdf_doc_upload" accept="pdf">
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>

                </div>
                <div class="form-group">
                    <label for="event_url"><span class="glyphicon glyphicon-user"></span> Url </label>
                    <input type="url" placeholder="https://example.com" pattern="https://.*" class="form-control" name="event_url" id="event_url">
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="event_phone">Phone</label>
                            <input type="text" class="form-control" name="event_phone" id="event_phone" value="{{ Helper::get_user_meta($data['user']->id,'phone',true) }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="event_email">Email</label>
                            <input type="email" class="form-control" name="event_email" id="event_email" value="{{ $data['user']->email }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6">
                        <label for="event_email">Youtube Video Link</label>
                        <input type="url" class="form-control" name="youtube_video_link" id="youtube_video_link" >
                    </div>
                    <div class="col-lg-6">
                        <label for="event_email">Vimeo Video Link</label>
                        <input type="url" class="form-control" name="vimeo_video_link" id="vimeo_video_link" >
                    </div>
                </div>

            </div>
            <button type="submit" id="add_event_button" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Add</button>
        </form>
    </div>

</div>
</div>
</div>
@endsection