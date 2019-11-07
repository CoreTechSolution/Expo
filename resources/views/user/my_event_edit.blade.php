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
                Profile Edit
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
            {{ Form::open(array(
                'url' => 'my-event-edit',
                'method' => 'post',
                'class' => 'form',  
                'files' => true
                )) }}
                {{ Form::hidden('id', $data['event']->id, array('id'=>'id','class'=>'form-control')) }}
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Title <span class="required">*</span></label>
                            <input type="text" name="event_title" id="event_title" class="form-control" value="{{ $data['event']->event_title }}"  required/>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Slug <span class="required">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ $data['event']->slug }}" required readonly="true" />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            
                            <label class="control-label">Headline <span class="required">*</span></label>

                            <input type="text" name="event_headline" id="event_headline" class="form-control" value="{{ $data['event']->event_headline }}" max="100" required/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="event_description" id="event_description" rows="10" class="form-control">{{ $data['event']->event_description }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Event Verticals <span class="required">*</span></label>

                            {{ Form::select('event_vertical_id', $data['event_verticals'] , $data['event']->event_vertical_id,array('placeholder'=>'Choose','id'=>'event_vertical_id','class'=>'form-control')) }}

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Event Type <span class="required">*</span></label>

                            {{ Form::select('event_type', $data['event_types'] , $data['event']->event_type,array('placeholder'=>'Choose','id'=>'event_type','class'=>'form-control')) }}

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Event Date</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="event_date_start" id="event_date_start" class="form-control datepicker" value="{{ $data['event']->event_date_start }}" readonly />
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="event_date_end" id="event_date_end" class="form-control datepicker" value="{{ $data['event']->event_date_end }}" readonly />
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Event Time</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="event_time_start" id="event_time_start" class="form-control timepicker" value="{{ $data['event']->event_time_start }}" readonly/>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="event_time_end" id="event_time_end" class="form-control timepicker" value="{{ $data['event']->event_time_end }}" readonly/>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Location</label>
                            <input type="text" class="form-control" name="event_location" id="event_location" value="{{ $data['event']->event_location }}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Country</label>

                            <input type="text" class="form-control" name="event_country" id="event_country" value="{{ $data['event']->event_country }}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="">City</label>

                                <input type="text" class="form-control" name="event_city" id="event_city" value="{{ $data['event']->event_city }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Attendees</label>
                            <input type="number" name="attendees" id="attendees" class="form-control datepicker" value="{{ $data['event']->attendees }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Exhibitory</label>
                            <input type="number" name="exhibitors" id="exhibitors" class="form-control" value="{{ $data['event']->exhibitors }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input type="text" name="event_phone" id="event_phone" class="form-control" value="{{ $data['event']->event_phone }}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="text" name="event_email" id="event_email" class="form-control" value="{{ $data['event']->event_email }}"/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Url</label>
                            <input type="url" name="event_url" id="event_url" class="form-control" value="{{ $data['event']->event_url }}" max="100"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Image</label><br>
                            <input type="file" name="event_image" id="event_image" />
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <div class="edit_img_preview">
                                <img src="{{ url('uploads/event_image/'.$data['event']->event_image) }}" alt="" style="width: 250px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Image Gallery</label><br>
                            <input type="file" class="" name="event_gallery_image[]" id="event_gallery_image" multiple>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <?php
                            $get_image_gallery=Helper::get_gallery_image('event',$data['event']->id);

                            if(!empty($get_image_gallery)){
                                foreach ($get_image_gallery as $image) {
                                    ?>
                            <div class="edit_gallery_preview">
                                <img src="{{ url('uploads/event_image/'.$image->image_path) }}" alt="" style="width: 150px;">
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Doc Upload</label><br>
                            <input type="file" name="pdf_doc_upload" id="pdf_doc_upload" />
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            @if(!empty($data['event']->pdf_doc_upload))
                            <?php $pdf_files=explode('/', $data['event']->pdf_doc_upload);
                            $file_name=$pdf_files[count($pdf_files)-1];
                            ?>
                            <a href="{{ url('uploads/event_image/'.$data['event']->pdf_doc_upload) }}">
                                <img src="{{ url('assets/images/pdf_preview.png') }}" alt="pdf preview" width="150">
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="event_email">Youtube Video Link</label>
                        <input type="url" class="form-control" name="youtube_video_link" id="youtube_video_link" value="{{ $data['event']->youtube_video_link }}">
                    </div>
                    <div class="col-lg-6">
                        <label for="event_email">Vimeo Video Link</label>
                        <input type="url" class="form-control" name="vimeo_video_link" id="vimeo_video_link" value="{{ $data['event']->vimeo_video_link }}">
                    </div>

                </div>
            
            <div class="form-group">
             <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('my-event-calender') }}" class="btn btn-default">cancel</a>
            </div>
        </div>



    </form>
</div>
</div>

</div>
</div>
</div>
</div>
@endsection