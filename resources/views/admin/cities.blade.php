@extends('layouts.admin')

@section('content')
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
            <div class="section_head">
                <div class="button_div pull-right">
                    <ul>
                        <li><a href="{{ route('admin.import_city') }}" class="btn btn-success">import from CSV</a></li>
                    </ul>
                </div>
            </div>
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">{{ $data['page_title'] }}</h2>
                </header>
                <div class="panel-body">

                    @if(!empty($data['cities']))
                    <table class="table table-bordered table-striped mb-none" id="example">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Cities</th>
                                <th>Slug</th>
                                <th>State</th>
                                <th>Created At</th>
                                <th >Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                        <?php $counter=1; ?>
                        @foreach($data['cities'] as $city)
                            <tr class="gradeX">
                                <td>{{ $counter }}</td>
                                <td>{{ $city->city_name }}</td>
                                <td>{{ $city->slug }}</td>
                                <td>{{ $city->state }}</td>
                                <td>{{ $city->created_at }}</td>
                                <td class="center">
                                    <a title="Edit" href="{{ url('admin/edit_city/'.$city->id) }}" class="btn btn-sm btn-sm-me btn-success"><i class="fa fa-pencil-square-o"></i></a>
                   
                                </td>
                               
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    @else
                    {{ __('No Data Found') }}

                    @endif


                    
                </div>
            </section>


        </div>
    </div>


</section>
@endsection