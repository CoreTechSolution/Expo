@extends('layouts.admin')

@section('content')
<!-- end: sidebar -->
<style type="text/css">
    form .error {
    color: #ff0000;
}
</style>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>{{ $data['page_title'] }}</h2>
        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>{{ $data['page_title'] }}</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Details</h2>
                </header>
                <div class="panel-body">
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
                {{ Form::open(array(
                    'url' => 'admin/event_view',
                    'method' => 'post',
                    'class' => 'form',  
                    'files' => true
                    )) }}
                    {{ Form::hidden('id', $data['event']->id, array('id'=>'id','class'=>'form-control')) }}
                    <div class="form-group">
                    <?php
                       /*  $event_meta_data=Helper::get_event_meta($data['event']->id,'event',false);
                        echo '<pre>';
                        print_r($event_meta_data); */
                    ?>
                        <label class="col-sm-2 control-label">Title <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="event_title" id="event_title" class="form-control" value="{{ $data['event']->event_title }}" max="100" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Slug <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $data['event']->slug }}" required readonly="true" />
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Event Verticals <span class="required">*</span></label>
                        <div class="col-sm-4">
                            {{ Form::select('event_vertical_id', $data['event_verticals'] , $data['event']->event_vertical_id,array('placeholder'=>'Choose','id'=>'event_vertical_id','class'=>'form-control')) }}
                        </div>
                        <label class="col-sm-2 control-label">Event Type <span class="required">*</span></label>
                        <div class="col-sm-4">
                            {{ Form::select('event_type', $data['event_types'] , $data['event']->event_type,array('placeholder'=>'Choose','id'=>'event_type','class'=>'form-control')) }}
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Headline</label>
                        <div class="col-sm-10">
                            <input type="text" name="event_headline" id="event_headline" class="form-control" value="{{ $data['event']->event_headline }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="event_description" id="event_description" rows="10" class="form-control">{{ $data['event']->event_description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Event Start Date</label>
                        <div class="col-sm-4">
                        <input type="text" name="event_date_start" id="event_date_start" class="form-control datepicker" value="{{ $data['event']->event_date_start }}" readonly />

                    </div>
                    <label class="col-sm-2 control-label">Event End Date</label>
                    <div class="col-sm-4">
                            <input type="text" name="event_date_end" id="event_date_end" class="form-control datepicker" value="{{ $data['event']->event_date_end }}" readonly/>

                        </div>
                    </div>
                    <?php 
                        $timings=unserialize($data['event']->event_time_start);

                    ?>
                    <div class="row">
                        <div class="col-sm-2">
                        </div>
                        <div id="edit_timings" class="edit_timings col-sm-6">
                        @if(!empty($timings))
                            @foreach($timings as $timing)
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{ $timing['date'] }}</label>
                                <div class="col-sm-4">
                                <input type="text" name="event_time_start1[]"  class="form-control timepicker" value="{{  $timing['time'] }}" readonly/>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" name="event_date_start1[]"  class="form-control datepicker" value="{{  $timing['date'] }}" readonly/>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        </div>
                    </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Last Year Date</label>
                    <div class="col-sm-4">
                    <input type="text" name="last_year_date" id="last_year_date" class="form-control " value="{{ Helper::get_event_meta($data['event']->id,'last_year_date',true) }}"  />

                </div>
                <label class="col-sm-2 control-label">Next Year Date</label>
                <div class="col-sm-4">
                        <input type="text" name="next_year_date" id="next_year_date" class="form-control " value="{{ Helper::get_event_meta($data['event']->id,'next_year_date',true) }}" />

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Vanue</label>
                    <div class="col-sm-4">
                        <input type="text" name="event_location" id="event_location" class="form-control" value="{{ $data['event']->event_location }}"/>

                    </div>
                    <label class="col-sm-1 control-label">Country</label>
                    <div class="col-sm-2">
                        <input type="text" name="event_country" id="event_country" class="form-control" value="{{ $data['event']->event_country }}"/>

                    </div>
                    <label class="col-sm-1 control-label">City</label>
                    <div class="col-sm-2">
                        <input type="text" name="event_city" id="event_city" class="form-control" value="{{ $data['event']->event_city }}"/>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Last Year Attendees</label>
                    <div class="col-sm-4">
                        <?php 
                            $last_year_attendees=Helper::get_event_meta($data['event']->id,'last_event_attendees',true);
                            //print_r($last_year_attendees); exit;
                        ?>
                        <input type="number" name="last_event_attendees" id="last_event_attendees" class="form-control" value="{{ $last_year_attendees }}"/>

                    </div>
                    <label class="col-sm-2 control-label">Last Year Exhibitors</label>
                    <?php 
                        $last_event_exhibitors=Helper::get_event_meta($data['event']->id,'last_event_exhibitors',true);
                        //print_r($last_year_attendees); exit;
                    ?>
                    <div class="col-sm-4">
                        <input type="number" name="last_event_exhibitors" id="last_event_exhibitors" class="form-control" value="{{ $last_event_exhibitors }}"/>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-4">
                        <input type="text" name="event_phone" id="event_phone" class="form-control" value="{{ $data['event']->event_phone }}"/>

                    </div>
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                        <input type="text" name="event_email" id="event_email" class="form-control" value="{{ $data['event']->event_email }}"/>

                    </div>
                </div>
                <div class="form-group">

                    <label class="col-sm-2 control-label">Url</label>
                    <div class="col-sm-10">
                        <input type="url" name="event_url" id="event_url" class="form-control" value="{{ $data['event']->event_url }}" max="100"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Attendees</label>
                    <div class="col-sm-4">
                    <?php
                    $attendees=Helper::get_event_user($data['event']->id,'attendee');
                    //echo '<pre>';
                    //print_r($attendees);
                    $attendee_drop_value=array();
                    if(!empty($attendees)){
                        foreach($attendees as $att){
                            array_push($attendee_drop_value,$att->id);
                        }
                    }
                    //print_r($attendee_drop_value);
                    ?>
                        {{ Form::select('attendees_list_show[]', $data['attendees_dropdown'] , $attendee_drop_value,array('id'=>'attendees_list_show','class'=>'form-control','multiple' => 'multiple')) }}
                    </div>
                    <label class="col-sm-2 control-label">Exhibitors</label>
                    <div class="col-sm-4">
                    <?php
                    $exhibitors=Helper::get_event_user($data['event']->id,'exhibitor');
                    //echo '<pre>';
                    //print_r($exhibitors);
                    $exhibitor_drop_value=array();
                    if(!empty($exhibitors)){
                        foreach($exhibitors as $exhibitor){
                            array_push($exhibitor_drop_value,$exhibitor->id);
                        }
                    }
                    ?>
                        {{ Form::select('exhibitors_list_show[]', $data['exhibitors_dropdown'] , $exhibitor_drop_value,array('id'=>'exhibitors_list_show','class'=>'form-control','multiple' => 'multiple')) }}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Attendees Info</label>
                    <div class="col-sm-4">
                        <textarea type="text" name="attendees_info" id="attendees_info" rows="6" class="form-control" >{{ Helper::get_event_meta($data['event']->id,'attendees_info',true) }}</textarea>

                    </div>
                    <label class="col-sm-2 control-label">Exhibitor Info</label>
                    <div class="col-sm-4">
                        <textarea type="text" name="exhibitor_info" id="exhibitor_info" rows="6" class="form-control" >{{ Helper::get_event_meta($data['event']->id,'exhibitor_info',true) }}</textarea>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Featured Image</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn" >
                                <a id="lfm" data-input="thumbnail" style="width:100px;" data-preview="holder" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="event_image" value="{{ $data['event']->event_image }}">
                        </div>
                    </div>
                    <?php
                        if(!empty($data['event']->event_image)){
                            $event_image=url($data['event']->event_image);
                        } else{
                            $event_image=url('uploads/no_images.png');
                        }
                    ?>
                    <div class="col-sm-4">
                        <div class="edit_img_preview">
                            <img id="holder" src="{{ $event_image }}" alt="" style="width: 250px;">
                        </div>
                    </div>
                </div>
                    <?php 
                    $gallery_images=array();
                    if(!empty($data['event']->gallery_image))
                    $gallery_images=unserialize($data['event']->gallery_image);
                    ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gallery Image</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn" >
                                <a id="gallaryimage1" data-input="gallerypath1" style="width:100px;" data-preview="galleryholder1" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="gallerypath1" class="form-control" type="text" name="event_gallery_image[]" value="{{ (!empty($gallery_images[0])) ? $gallery_images[0] : '' }}">
                        </div>
                        <div class="edit_img_preview" style="margin:5px 0;">
                            <img id="galleryholder1" src="{{ (!empty($gallery_images[0])) ? url($gallery_images[0]) : '' }}" alt="" style="width: 250px;">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn" >
                                <a id="gallaryimage2" data-input="gallerypath2" style="width:100px;" data-preview="galleryholder2" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="gallerypath2" class="form-control" type="text" name="event_gallery_image[]" value="{{ (!empty($gallery_images[1])) ? $gallery_images[1] : '' }}">
                        </div>
                        <div class="edit_img_preview" style="margin:5px 0;">
                            <img id="galleryholder2" src="{{ (!empty($gallery_images[1])) ? url($gallery_images[1]) : '' }}" alt="" style="width: 250px;">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn" >
                                <a id="gallaryimage3" data-input="gallerypath3" style="width:100px;" data-preview="galleryholder3" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="gallerypath3" class="form-control" type="text" name="event_gallery_image[]" value="{{ (!empty($gallery_images[2])) ? $gallery_images[2] : '' }}">
                        </div>
                        <div class="edit_img_preview" style="margin:5px 0;">
                            <img id="galleryholder3" src="{{ (!empty($gallery_images[2])) ? url($gallery_images[2]) : '' }}" alt="" style="width: 250px;">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-btn" >
                                <a id="gallaryimage4" data-input="gallerypath4" style="width:100px;" data-preview="galleryholder4" class="btn btn-primary">
                                <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="gallerypath4" class="form-control" type="text" name="event_gallery_image[]" value="{{ (!empty($gallery_images[3])) ? $gallery_images[3] : '' }}">
                        </div>
                        <div class="edit_img_preview" style="margin:5px 0;">
                            <img id="galleryholder4" src="{{ (!empty($gallery_images[3])) ? url($gallery_images[3]) : '' }}" alt="" style="width: 250px;">
                        </div>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Youtube Video Link</label>
                    <div class="col-sm-10">
                        <input type="url" class="form-control" name="youtube_video_link" id="youtube_video_link" value="{{ $data['event']->youtube_video_link }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="event_email" class="col-sm-2 control-label">Vimeo Video Link</label>
                    <div class="col-sm-10">
                        <input type="url" class="form-control" name="vimeo_video_link" id="vimeo_video_link" value="{{ $data['event']->vimeo_video_link }}">
                    </div>
                        
                
                </div>
                <div class="form-group">

                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-4">
                        {{ Form::select('status', array('1'=>'Approved','2'=>'Un-Approve','3'=>'Event Passed','4'=>'Cancel') , $data['event']->status,array('placeholder'=>'Choose','id'=>'status','class'=>'form-control')) }}
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6">
                        @if($data['event']->is_top==1)
                            <input type="checkbox" value="1" name="is_top" checked> Top Event
                        @else
                            <input type="checkbox" value="1" name="is_top"> Top Event
                        @endif

                        @if($data['event']->is_featured==1)
                            <input type="checkbox" value="1" name="is_featured" checked> Featured Event
                        @else
                            <input type="checkbox" value="1" name="is_featured"> Featured Event
                        @endif
                        
                    </div>
                    
                    
                </div>

                <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.events') }}" class="btn btn-default">cancel</a>
                </div>
            </div>



        </form>
    </div>
</section>


</div>
</div>


</section>
@endsection

