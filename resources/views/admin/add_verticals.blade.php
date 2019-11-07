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
                    <form id="form" action="{{ route('admin.add_event_verticals.submit') }}" class="form-horizontal" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Title <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="event_verticals_name" id="event_verticals_name" class="form-control"  required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Slug <span class="required">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" id="slug" class="form-control" required readonly="true" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="event_verticals_descriptions" rows="15" class="form-control" placeholder="Page display content write here" ></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                         <div class="col-sm-10 col-sm-offset-2">
                            <button class="btn btn-primary">Submit</button>
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

