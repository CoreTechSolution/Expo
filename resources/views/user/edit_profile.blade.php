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
            <form method="POST" action="{{ route('edit-profile.submit') }}" enctype="multipart/form-data">
                <?php
                    //print_r($data['user']); exit;
                ?>
                @csrf
                <input type="hidden" name="user_type" value="{{ $data['user']->user_type }}">
                <input type="hidden" name="id" value="{{ $data['user']->id }}">
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data['user']->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                 @if($data['user']->user_type!='company')
                <div class="form-group row">
                    <label for="company" class="col-md-2 col-form-label">{{ __('Company') }}</label>

                    <div class="col-md-6">
                        {{ Form::select('company', Helper::returnDropDownQuery('users',"user_type='company'",'id','name','name'),$data['user']->company ,array('placeholder'=>'Select','id'=>'company','required'=>true)) }}
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <label for="profile_pic" class="col-md-2 col-form-label">{{ __('Profile Image') }}</label>

                    <div class="col-md-4">
                        <input type="file" name="profile_pic" id="profile_pic">
                    </div>
                    <div class="col-md-6">
                        @if(!empty($data['user']->profile_pic))
                        <div class="edit_img_preview">
                            <img src="{{ url('uploads/profile_pics/'.$data['user']->profile_pic) }}" alt="">
                        </div>
                        @endif

                    </div>
                </div>
                <div class="form-group row">
                    <label for="about" class="col-md-2 col-form-label">{{ __('About') }}</label>

                    <div class="col-md-6">
                        <textarea id="about" name="about" class="form-control" >{{ Helper::get_user_meta($data['user']->id,'about',true) }}</textarea> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-2 col-form-label">{{ __('Address') }}</label>

                    <div class="col-md-6">
                        <textarea id="address" name="address" class="form-control" >{{ Helper::get_user_meta($data['user']->id,'address',true) }}</textarea> 

                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-2 col-form-label">{{ __('Phone') }}</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ Helper::get_user_meta($data['user']->id,'phone',true) }}" >
                    </div>
                </div>

                <!--################### for vendor only start ##############-->
                @if($data['user']->user_type=='vendor')
                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label">{{ __('Category') }}</label>

                        <div class="col-md-6">
                            {{ Form::select('vendor_category', $data['vendor_categories'] , Helper::get_user_meta($data['user']->id,'vendor_category',true),array('placeholder'=>'Select Category','id'=>'vendor_category')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label">{{ __('service area') }}</label>

                        <div class="col-md-6">
                            {{ Form::select('service_area', Helper::returnDropDownQuery('cities','','id','city_name','city_name'),Helper::get_user_meta($data['user']->id,'service_area',true) ,array('id'=>'service_area')) }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="services" class="col-md-2 col-form-label">{{ __('Services') }}</label>
                        <div class="col-md-6">
                            <textarea id="services" name="services" class="form-control" >{{ Helper::get_user_meta($data['user']->id,'services',true) }}</textarea> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="products" class="col-md-2 col-form-label">{{ __('Products') }}</label>
                        <div class="col-md-6">
                            <textarea id="products" name="products" class="form-control" >{{ Helper::get_user_meta($data['user']->id,'products',true) }}</textarea> 
                        </div>
                    </div>
                @endif
                <!--################### for vendor only end ##############-->


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