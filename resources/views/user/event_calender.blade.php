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
                        {{ $data['page_title'] }}
                    </div>
                    <div class="dash_page_body">

                        <div class="row">
                            @if($data['events']->count()>0)
                                @foreach($data['events'] as $event)
                                    <div class="col-lg-6">
                                        <div class="dashboard_event_box">
                                            <div class="event_title">
                                                {{ $event->event_title }}
                                            </div>
                                            <div class="short_description">
                                                {{ str_limit($event->event_description, 150, '...') }}
                                            </div>
                                            <div class="details">
                                                <div class="data_time">
                                                    {{Helper::date_formate_change( $event->event_date_start,'d M Y')}}
                                                </div>
                                                <div class="view_more">
                                                    <a href="{{ url('event-details/'.$event->slug) }}"> View More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h4>No event found in your calender</h4>
                            @endif


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
