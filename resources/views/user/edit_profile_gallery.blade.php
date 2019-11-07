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
            <form method="POST" action="{{ route('edit-profile-gallery.submit') }}" enctype="multipart/form-data">
                <?php
                    //print_r($data['user']); exit;
                ?>
                @csrf
                <input type="hidden" name="user_type" value="{{ $data['user']->user_type }}">
                <input type="hidden" name="id" value="{{ $data['user']->id }}">
                <?php 
                    $gallery_images=array();
                    $gallery_images=Helper::get_user_meta($data['user']->id,'gallery',true);
                    if(!empty($gallery_images))
                    $gallery_images=unserialize($gallery_images);
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
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
                        </button>
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