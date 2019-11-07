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

                    <h2 class="panel-title">Import</h2>
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
                        'url' => 'admin/import_vendor_category',
                        'method' => 'post',
                        'class' => 'form',  
                        'files' => true
                    )) }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Import CSV <span class="required">*</span></label>
                            <div class="col-sm-10">
                            	{{ Form::file('import_csv', array('placeholder'=>'Choose CSV File','id'=>'import_csv','accept'=>'.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel')) }}
                                <!-- <input type="file" name="import_csv" class=""  required/> -->
                            </div>
                        </div>

                        <div class="form-group">
                         <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Import</button>
                            <a href="{{ route('admin.vendor_categories') }}" class="btn btn-default">cancel</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ url('public/uploads/sample/vendor_category.csv') }}"><i class="fa fa-download" aria-hidden="true"></i> Download sample csv </a>
                        </div>
                    </div>

                </form>
            </div>
        </section>


    </div>
</div>


</section>
@endsection

