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
                        'url' => 'admin/add_company',
                        'method' => 'post',
                        'class' => 'form',  
                        'files' => true
                    )) }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name <span class="required">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required/>
                            </div>
                        
                            <label class="col-sm-2 control-label">Email <span class="required">*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}"/>
                            </div>
                        
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-4">
                                <textarea  name="address" id="address" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea  name="description" id="description" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Link to Wikipedia</label>
                            <div class="col-sm-10">
                                <input type="text" name="link_to_wikipedia" id="link_to_wikipedia" class="form-control" value="{{ old('link_to_wikipedia') }}"/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Logo</label>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-btn" >
                                        <a id="gallaryimage1" data-input="gallerypath1" style="width:100px;" data-preview="galleryholder1" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="gallerypath1" class="form-control" type="text" name="profile_pic" value="">
                                </div>
                                
                            </div>
                            <div class="col-sm-4">
                                <div class="edit_img_preview" style="margin:5px 0;">
                                    <img id="galleryholder1" src="" alt="" style="width: 250px;">
                                </div>
                            </div>
                        </div>

                    
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Gallery Image</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <span class="input-group-btn" >
                                            <a id="gallaryimage2" data-input="gallerypath2" style="width:100px;" data-preview="galleryholder2" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                        <input id="gallerypath2" class="form-control" type="text" name="company_gallery_image[]" value="">
                                    </div>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <div class="edit_img_preview" style="margin:5px 0;">
                                        <img id="galleryholder2" src="" alt="" style="width: 250px;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="dynamic_image_gallery_field" style="margin-bottom:15px;">
                                    
                                </div>
                            </div>
                       
                       <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <a href="javascript:void(0);" class="btn btn-small btn-default add_gallery_image_a" data-id="2">Add another image</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sponsor Event</label>
                            <div class="col-sm-4">
                                {{ Form::select('sponsor_list_show[]', $data['events_droppdown'] , '',array('id'=>'sponsor_list_show1','class'=>'form-control','multiple' => 'multiple')) }}
                            </div>
                        
                            <label class="col-sm-2 control-label">Attendee Event</label>
                            <div class="col-sm-4">
                                {{ Form::select('attendee_list_show[]', $data['events_droppdown'] , '',array('id'=>'attendee_list_show1','class'=>'form-control','multiple' => 'multiple')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Speaker Event</label>
                            <div class="col-sm-4">
                                {{ Form::select('speaker_list_show[]', $data['events_droppdown'] , '',array('id'=>'speaker_list_show1','class'=>'form-control','multiple' => 'multiple')) }}
                            </div>
                       
                            <label class="col-sm-2 control-label">Exhibitor Event</label>
                            <div class="col-sm-4">
                                {{ Form::select('exhibitor_list_show[]', $data['events_droppdown'] , '',array('id'=>'exhibitor_list_show1','class'=>'form-control','multiple' => 'multiple')) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.companies') }}" class="btn btn-default">cancel</a>
                            </div>
                        </div>
                        
                </form>
            </div>
        </section>
    </div>
</div>
</section>
@endsection