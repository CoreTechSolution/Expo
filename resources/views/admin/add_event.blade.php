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
                    'url' => 'admin/add_event',
                    'method' => 'post',
                    'class' => 'form',
                    'files' => true
                    )) }}

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Title <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="event_title" id="event_title" class="form-control" value="{{ old('event_title') }}" max="100" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Slug <span class="required">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required readonly="true" />
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-sm-2 control-label">Event Verticals <span class="required">*</span></label>
                        <div class="col-sm-4">
                            {{ Form::select('event_vertical_id', $data['event_verticals'] , old('event_vertical_id'),array('placeholder'=>'Choose','id'=>'event_vertical_id','class'=>'form-control')) }}
                        </div>
                        <label class="col-sm-2 control-label">Event Type <span class="required">*</span></label>
                        <div class="col-sm-4">
                            {{ Form::select('event_type', $data['event_types'] , old('event_type'),array('placeholder'=>'Choose','id'=>'event_type','class'=>'form-control')) }}
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Headline</label>
                        <div class="col-sm-10">
                            <input type="text" name="event_headline" id="event_headline" class="form-control" value="{{ old('event_headline') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea name="event_description" id="event_description" rows="10" class="form-control">{{ old('event_description') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Event Start Date</label>
                        <div class="col-sm-3">
                            <input type="text" name="event_date_start" id="event_date_start" class="form-control datepicker" value="{{ old('event_date_start') }}" />

                        </div>
                        <label class="col-sm-2 control-label">Event End Date</label>
                        <div class="col-sm-3">
                            <input type="text" name="event_date_end" id="event_date_end" class="form-control datepicker" value="{{ old('event_date_end') }}"/>
                        </div>
                        <div class="col-sm-2">
                            <a href="javascript:void(0)" id="event_edit_add_time" class="btn btn-small btn-info">Add Time</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                            <div id="event_edit_add_time_html">
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Last Year Date</label>
                        <div class="col-sm-4">
                        <input type="text" name="last_year_date" id="last_year_date" class="form-control " value="{{ old('last_year_date') }}"  />

                    </div>
                    <label class="col-sm-2 control-label">Next Year Date</label>
                    <div class="col-sm-4">
                            <input type="text" name="next_year_date" id="next_year_date" class="form-control " value="{{ old('next_year_date') }}" />

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Vanue</label>
                        <div class="col-sm-4">
                            <input type="text" name="event_location" id="event_location" class="form-control" value="{{ old('event_location') }}"/>

                        </div>
                        <label class="col-sm-1 control-label">Country</label>
                        <div class="col-sm-2">
                            <input type="text" name="event_country" id="event_country" class="form-control" value="{{ old('event_country') }}"/>

                        </div>
                        <label class="col-sm-1 control-label">City</label>
                        <div class="col-sm-2">
                            <input type="text" name="event_city" id="event_city" class="form-control" value="{{ old('event_city') }}"/>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Last Year Attendees</label>
                        <div class="col-sm-4">
                            <input type="number" name="last_event_attendees" id="last_event_attendees" class="form-control" value="{{ old('last_event_attendees') }}"/>
                        </div>
                        <label class="col-sm-2 control-label">Last Year Exhibitors</label>
                        <div class="col-sm-4">
                            <input type="number" name="last_event_exhibitors" id="last_event_exhibitors" class="form-control" value="{{ old('last_event_exhibitors') }}"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-4">
                            <input type="text" name="event_phone" id="event_phone" class="form-control" value="{{ old('event_phone') }}"/>

                        </div>
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                            <input type="text" name="event_email" id="event_email" class="form-control" value="{{ old('event_email') }}"/>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Url</label>
                        <div class="col-sm-10">
                            <input type="url" name="event_url" id="event_url" class="form-control" value="{{ old('event_url') }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attendees</label>
                        <div class="col-sm-4">
                            {{ Form::select('attendees_list_show[]', $data['attendees_dropdown'] , '',array('id'=>'attendees_list_show','class'=>'form-control','multiple' => 'multiple')) }}
                        </div>
                        <label class="col-sm-2 control-label">Exhibitors</label>
                        <div class="col-sm-4">
                            {{ Form::select('exhibitors_list_show[]', $data['exhibitors_dropdown'] , '',array('id'=>'exhibitors_list_show','class'=>'form-control','multiple' => 'multiple')) }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Attendees Info</label>
                        <div class="col-sm-4">
                            <textarea type="text" name="attendees_info" id="attendees_info" rows="6" class="form-control" >{{ old('attendees_info') }}</textarea>
                        </div>
                        <label class="col-sm-2 control-label">Exhibitor Info</label>
                        <div class="col-sm-4">
                            <textarea type="text" name="exhibitor_info" id="exhibitor_info" rows="6" class="form-control" >{{ old('exhibitor_info') }}</textarea>
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
                                <input id="thumbnail" class="form-control" type="text" name="event_image" value="">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="edit_img_preview">
                                <img id="holder" src="" alt="" style="width: 250px;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gallery Image</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-btn" >
                                    <a id="gallaryimage1" data-input="gallerypath1" style="width:100px;" data-preview="galleryholder1" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="gallerypath1" class="form-control" type="text" name="event_gallery_image[]" value="">
                            </div>
                            <div class="edit_img_preview" style="margin:5px 0;">
                                <img id="galleryholder1" src="" alt="" style="width: 250px;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-btn" >
                                    <a id="gallaryimage2" data-input="gallerypath2" style="width:100px;" data-preview="galleryholder2" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="gallerypath2" class="form-control" type="text" name="event_gallery_image[]" value="">
                            </div>
                            <div class="edit_img_preview" style="margin:5px 0;">
                                <img id="galleryholder2" src="" alt="" style="width: 250px;">
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
                                <input id="gallerypath3" class="form-control" type="text" name="event_gallery_image[]" value="">
                            </div>
                            <div class="edit_img_preview" style="margin:5px 0;">
                                <img id="galleryholder3" src="" alt="" style="width: 250px;">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-btn" >
                                    <a id="gallaryimage4" data-input="gallerypath4" style="width:100px;" data-preview="galleryholder4" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="gallerypath4" class="form-control" type="text" name="event_gallery_image[]" value="">
                            </div>
                            <div class="edit_img_preview" style="margin:5px 0;">
                                <img id="galleryholder4" src="" alt="" style="width: 250px;">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Youtube Video Link</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" name="youtube_video_link" id="youtube_video_link" value="{{ old('youtube_video_link') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="event_email" class="col-sm-2 control-label">Vimeo Video Link</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" name="vimeo_video_link" id="vimeo_video_link" value="{{ old('vimeo_video_link') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                            {{ Form::select('status', array('1'=>'Approved','2'=>'Un-Approve','3'=>'Event Passed','4'=>'Cancel') , '',array('placeholder'=>'Choose','id'=>'status','class'=>'form-control')) }}
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-6">
                            <input type="checkbox" value="1" name="is_top"> Top Event
                            <input type="checkbox" value="1" name="is_featured"> Featured Event 
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

