@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
               @include('template-part.event_sidebar')
               
            </div>
            <div class="col-lg-9">
                <div class="page_title">
                    <h2>{{ $data['page_title'] }}</h2>
                </div>
                <div class="page_content">
                    @if($data['events']->count()>0)
                    <?php //var_dump($data['events']); exit; ?>
                    <div class="event_list">
                        <div class="row">
                            @foreach($data['events'] as $event)
                            
                            <div class="col-lg-4">
                                <a href="{{ url('event-details/'.$event->slug) }}">
                                    <div class="event_box">
                                    @php
                                    if(!empty($event->event_image)){
                                        $bg_img= url($event->event_image);
                                    } else{
                                        $bg_img= url('uploads/no_images.png');
                                    }
                                    @endphp
                                        <div class="event_feature_image" style="background-image: url({{ $bg_img }});">
                                           
                                        </div>
                                        <div class="event_title">
                                            {{ $event->event_title }}
                                        </div>
                                        <div class="event_state">
                                            <span class="pull-left">
                                                {{ $event->event_country }}
                                            </span>
                                            <span class="pull-right">
                                                {{ Helper::date_formate_change($event->event_date_start) }}
                                            </span>
                                            
                                        </div>
                                    </div>
                                </a>
                                
                            </div>
                            @endforeach
                        </div>
                        <div class="pagination_lonk_div">
                            {{ $data['events']->links() }}
                        </div>
                    </div>
                    @else
                        <h5>No Event found!</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection