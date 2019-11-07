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
                        'url' => 'admin/edit_city',
                        'method' => 'post',
                        'class' => 'form',  
                        'files' => true
                    )) }}
                     {{ Form::hidden('id', $data['city']->id, array('placeholder'=>'Chess Board','id'=>'id','class'=>'form-control')) }}
                        <div class="form-group">
                        	
                            <label class="col-sm-2 control-label">City <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="city_name" id="city_name" class="form-control" value="{{ $data['city']->city_name }}" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slug <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ $data['city']->slug }}" required readonly="true" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Short Name</label>
                            <div class="col-sm-10">
                            	<input type="text" name="short_name" id="short_name" class="form-control" value="{{ $data['city']->short_name }}"/>
                                
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

