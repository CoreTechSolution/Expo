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
                        <li><a href="{{ route('admin.add_event') }}" class="btn btn-success">Add New</a></li>
                        <li><a href="{{ route('admin.import_events') }}" class="btn btn-info">import from CSV</a></li>
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

                    @if(!empty($data['events']))
                    <table class="table table-bordered table-striped mb-none" id="example">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>created by</th>
                                <th>Status</th>
                                <th >Action</th>

                            </tr>
                        </thead>
                        <tbody>

                        <?php $counter=1; ?>
                        @foreach($data['events'] as $event)
                            <tr class="gradeX">
                                <td>{{ $counter }}</td>
                                <td>{{ $event->event_title }}</td>
                                <td>{{ $event->event_date }}</td>
                                <td>{{ $event->event_time }}</td>
                                <td>{{ Helper::get_user_data( $event->created_by,'name',true) }}</td>
                                <td>
                                    <?php
                                        $toggle_header_text='Un-approved';
                                        $checked='';
                                        if($event->status=='1'){
                                            $toggle_header_text='Approved';
                                            $checked='checked';
                                        } elseif($event->status=='2'){
                                            $toggle_header_text='Un-Approved';
                                            $checked='';
                                        } elseif($event->status=='3'){
                                            $toggle_header_text='Passed';
                                            $checked='readonly';
                                        } elseif($event->status=='4'){
                                            $toggle_header_text='Canceled';
                                            $checked='readonly';
                                        }

                                    ?>
                                    <div class="toggle_switch_box">
                                        <span class="toggle_swoch_header_text">{{ $toggle_header_text }}</span>
                                        <label class="switch">
                                            <input type="checkbox" class="toggle_switch_checkbox" name='status' value="1" <?php echo $checked; ?>>
                                          <span class="slider round"></span>
                                      </label>
                                    </div>

                                </td>
                                <td class="center">
                                    <a title="Edit" href="{{ url('admin/event_view/'.$event->id) }}" class="btn btn-sm btn-sm-me btn-success"><i class="fa fa-edit"></i></a>

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
