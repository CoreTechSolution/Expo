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
                    <form id="form" action="{{ route('admin.add_vendor_testimonials.submit') }}" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Vendor <span class="required">*</span></label>
                            <div class="col-sm-10">
                                {{ Form::select('vendor_id', $data['vendors_dropdown'] , '',array('id'=>'vendor_id','class'=>'form-control')) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">User </label>
                            <div class="col-sm-10">
                                <input type="text" name="user_name" id="user_name" class="form-control"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-btn" >
                                        <a id="lfm" data-input="thumbnail" style="width:100px;" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="user_image">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="edit_img_preview">
                                    <img id="holder" src="" alt="" style="width: 250px;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-10">
                                <textarea name="content" rows="15" class="form-control" placeholder="content write here" ></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                         <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.vendor_categories') }}" class="btn btn-default">cancel</a>
                        </div>
                    </div>



                </form>
            </div>
        </section>


    </div>
</div>


</section>
@endsection

