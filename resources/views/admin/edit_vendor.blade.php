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
                        'url' => 'admin/edit_vendor',
                        'method' => 'post',
                        'class' => 'form',  
                        'files' => true
                    )) }}
                     {{ Form::hidden('id', $data['vendor']->id, array('placeholder'=>'Chess Board','id'=>'id','class'=>'form-control')) }}
                        <div class="form-group">
                        	
                            <label class="col-sm-2 control-label">Name <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control" value="{{ $data['vendor']->name }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="email" class="form-control" value="{{ $data['vendor']->email }}" required readonly="true"/>
                            </div>
                        </div>
                        <div class="form-group ">
		                    <label for="profile_pic" class="col-md-2 col-form-label">{{ __('Profile Image') }}</label>

		                    <div class="col-md-4">
		                        <input type="file" name="profile_pic" id="profile_pic">
		                    </div>
		                    <div class="col-md-6">
		                        @if(!empty($data['vendor']->profile_pic))
		                        <div class="edit_img_preview">
		                            <img src="{{ url('uploads/profile_pics/'.$data['vendor']->profile_pic) }}" alt="">
		                        </div>
		                        @endif
		                    </div>
		                </div>

                        
		                <div class="form-group">
		                    <label for="about" class="col-sm-2 control-label">{{ __('About') }}</label>

		                    <div class="col-sm-10">
		                        <textarea id="about" name="about" class="form-control" rows="6" >{{ Helper::get_user_meta($data['vendor']->id,'about',true) }}</textarea> 
		                    </div>
		                </div>
						<div class="form-group">
		                    <label for="address" class="col-sm-2 control-label">{{ __('Address') }}</label>

		                    <div class="col-sm-10">
		                        <textarea id="address" name="address" class="form-control" >{{ Helper::get_user_meta($data['vendor']->id,'address',true) }}</textarea> 

		                    </div>
		                </div>
                        <div class="form-group">
		                    <label for="company" class="col-sm-2 control-label">{{ __('Company') }}</label>

		                    <div class="col-sm-4">
		                        {{ Form::select('company', Helper::returnDropDownQuery('users',"user_type='company'",'id','name','name'),$data['vendor']->company ,array('placeholder'=>'Select','id'=>'company','required'=>true)) }}
		                    </div>
                            <label for="phone" class="col-sm-2 control-label">{{ __('Phone') }}</label>

		                    <div class="col-sm-4">
		                        <input type="text" id="phone" name="phone" class="form-control" value="{{ Helper::get_user_meta($data['vendor']->id,'phone',true) }}">

		                    </div>
		                </div>
		                <div class="form-group">
	                        <label for="vendor_category" class="col-sm-2 control-label">{{ __('Category') }}</label>

	                        <div class="col-sm-4">
	                            {{ Form::select('vendor_category', $data['vendor_categories'] , Helper::get_user_meta($data['vendor']->id,'vendor_category',true),array('placeholder'=>'Select Category','id'=>'vendor_category')) }}
	                        </div>
                            <label for="service_area" class="col-sm-2 control-label">{{ __('Service area') }}</label>

	                        <div class="col-sm-4">
	                            {{ Form::select('service_area', Helper::returnDropDownQuery('cities','','id','city_name','city_name'),Helper::get_user_meta($data['vendor']->id,'service_area',true) ,array('id'=>'service_area')) }}
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <label for="services" class="col-sm-2 control-label">{{ __('Services') }} </label><small>Use comma (",") separated value for multiple services</small>
		                    <div class="col-sm-10">
		                        <textarea id="services" name="services" class="form-control" >{{ Helper::get_user_meta($data['vendor']->id,'services',true) }}</textarea> 

		                    </div>
		                </div>
		                <div class="form-group">
		                    <label for="products" class="col-sm-2 control-label">{{ __('Products') }} </label><small>Use comma (",") separated value for multiple products</small>
		                    <div class="col-sm-10">
		                        <textarea id="products" name="products" class="form-control" >{{ Helper::get_user_meta($data['vendor']->id,'products',true) }}</textarea> 

		                    </div>
		                </div>

                         <?php 
                            $gallery_images=array();
                            $gallery_images=Helper::get_user_meta($data['vendor']->id,'gallery',true);
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
                        <div class="form-group">
                         <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.pages') }}" class="btn btn-default">cancel</a>
                        </div>
                    </div>



                </form>
            </div>
        </section>


    </div>
</div>


</section>
@endsection