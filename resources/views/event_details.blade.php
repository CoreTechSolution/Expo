@extends('layouts.app')
@section('content')


<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="page_content">
                    <?php
                        //$event_image=url('uploads/event_image/'.$data['event']->event_image);
                        //$event_image=url('assets/images/no-preview-big1.jpg');
                        if(!empty($data['event']->event_image)){
                            $event_image=url($data['event']->event_image);
                        } else{
                            $event_image=url('uploads/no_images.png');
                        }
                        
                    ?>
                    <div class="event_page_header"
                        style="background: url({{ $event_image }}); background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;">
                        <div class="event_page_title">
                            <h2>{{ $data['page_title'] }}</h2>
                            <span class="event_date"><i class="far fa-clock"></i>
                                @if($data['event']->event_date_start==$data['event']->event_date_end)
                                Date: {{ Helper::date_formate_change($data['event']->event_date_start,'d M Y') }}
                                Time: {{ Helper::date_formate_change($data['event']->event_time_start,'H:i') }} -
                                {{ Helper::date_formate_change($data['event']->event_time_end,'H:i') }}
                                @else
                                Date: {{ Helper::date_formate_change($data['event']->event_date_start,'d M Y') }} -
                                {{ Helper::date_formate_change($data['event']->event_date_end,'d M Y') }}

                                @endif
                            </span>
                            <span class="event_add_to_callender">
                                <?php
                            $aleady_added='0';
                            $a_text='+ Add to My Event Calender';
                            if(Auth::check()){
                                $check_added_event= Helper::check_added_event(array('user_id'=>Auth::user()->id,'event_id'=>$data['event']->id));
                                if($check_added_event==true){
                                    $aleady_added='1';
                                    $a_text='View calender';
                                } else{
                                    $aleady_added='0';
                                    $a_text='Add to My Event Calender';
                                }
                            }

                            ?>
                            @guest
                                <a id="add_to_calender" href="#" event_id="{{ $data['event']->id }}"
                                    style="color: #bbbbbb;" data_status="{{ $aleady_added }}">{{ $a_text }}</a></span>
                            @else
                            <a id="add_to_calender" href="#" event_id="{{ $data['event']->id }}" style="color: #ffffff;"
                                data_status="{{ $aleady_added }}">{{ $a_text }}</a></span>
                            @endguest

                            <span class="event_address"><i class="fas fa-location-arrow"></i>
                                {{ $data['event']->event_location.', '.$data['event']->event_city.', '.$data['event']->event_country }}</span>
                            <span class="event_type">
                                {{ Helper::get_returnvaluefield('event_type','id',$data['event']->event_type,'name') }}
                            </span>
                            <span class="event_social_media">

                                <ul>
                                    <?php
                                    $facebook_link=Helper::get_event_meta($data['event']->id,'facebook_link',true);
                                    ?>
                                    @if(!empty($facebook_link))
                                    <li><a href="{{ $facebook_link }}"><i class="fab fa-facebook-square"></i></a></li>
                                    @endif

                                    <?php
                                    $instagram_link=Helper::get_event_meta($data['event']->id,'instagram_link',true);
                                    ?>
                                    @if(!empty($instagram_link))
                                    <li><a href="{{ $instagram_link }}"><i class="fab fa-instagram"></i></a></li>
                                    @endif

                                    <?php
                                    $linkedin_link=Helper::get_event_meta($data['event']->id,'linkedin_link',true);
                                    ?>
                                    @if(!empty($linkedin_link))
                                    <li><a href="{{ $linkedin_link }}"><i class="fab fa-linkedin"></i></a></li>
                                    @endif

                                    <?php
                                    $twitter_link=Helper::get_event_meta($data['event']->id,'twitter_link',true);
                                    ?>
                                    @if(!empty($twitter_link))
                                    <li><a href="{{ $twitter_link }}"><i class="fab fa-twitter-square"></i></a></li>
                                    @endif
                                </ul>
                            </span>
                        </div>
                    </div>
                    <div class="event_page_body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation"><a href="#about" aria-controls="about" role="tab" data-toggle="tab"
                                    class="active show"> <span>About</span></a></li>
                            <li role="presentation"><a href="#users" aria-controls="users" role="tab"
                                    data-toggle="tab"><span>Attendees</span></a></li>
                            <li role="presentation"><a href="#exhibitors" aria-controls="exhibitors" role="tab"
                                    data-toggle="tab"><span>Exhibitors</span></a></li>
                            <li role="presentation"><a href="#gallery" aria-controls="gallery" role="tab"
                                    data-toggle="tab"><span>Gallery</span></a></li>
                            <li role="presentation"><a href="#video" aria-controls="video" role="tab"
                                    data-toggle="tab"><span>Videos</span></a></li>
                        </ul>

                        <!-- Tab panes -->
                        
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="about">
                                <div class="event_description">
                                    {{ stripslashes($data['event']->event_description) }}
                                </div>
                                <div class="event_conracr_info">
                                    <h5>Contact information</h5>
                                    <hr>
                                    @if(!empty($data['event']->event_phone))
                                    <b>Phone: </b>{{ $data['event']->event_phone }}<br>
                                    @endif
                                    @if(!empty($data['event']->event_email))
                                    <b>Email: </b><a
                                        href="mailto:{{ $data['event']->event_email }}">{{ $data['event']->event_email }}</a><br>
                                    @endif
                                    @if(!empty($data['event']->event_url))
                                    <b>URL: </b><a href="{{ $data['event']->event_url }}" target="_blank">{{ $data['event']->event_url }}</a><br>
                                    @endif
                                </div>
                                <div class="event_other_details">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                                $times=unserialize($data['event']->event_time_start);
                                                if(!empty($times)){ ?>
                                            <?php
                                                $date = new DateTime($times[0]['date']);
                                                $now = new DateTime();

                                                if($date < $now) {
                                                    $extra_text='Event has passed – was on ';
                                                    $extra_text1='Next event will take place on ' .Helper::get_event_meta($data['event']->id,'next_year_date',true);
                                                } else {
                                                    $extra_text='';
                                                    $extra_text1='';
                                                }
                                            ?>
                                             <h6>What you need to know:</h6>
                                             <span class="timing_date_pre">{{ $extra_text }}</span>
                                                <?php foreach ($times as $time) { ?>

                                            <span class="timing_date">{{ $time['time'] }} ({{ date('d M Y',strtotime($time['date'])) }})</span>

                                            <?php } ?>
                                            <span class="timing_date_post">{{ $extra_text1 }}</span>

                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-sm-6">
                                            <h6>Category & Type</h6>
                                            {{ Helper::get_returnvaluefield('event_type','id',$data['event']->event_type,'name') }}<br>
                                            {{ Helper::get_returnvaluefield('event_verticals','id',$data['event']->event_vertical_id,'event_verticals_name') }}
                                        </div>
                                    </div>


                                </div>
                                <div class="event_other_details">
                                    <h6>Last Year Details</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?php
                                                $last_year_date=Helper::get_event_meta($data['event']->id,'last_year_date',true );
                                            ?>
                                            @if(!empty($last_year_date))
                                            <b>Date: </b>{{ $last_year_date }}<br>
                                            @endif
                                            <?php
                                                $last_event_exhibitors=Helper::get_event_meta($data['event']->id,'last_event_exhibitors',true );
                                            ?>
                                            @if(!empty($last_event_exhibitors))
                                            <b>Exhibitors: </b>{{ $last_event_exhibitors }}<br>
                                            @endif
                                            <?php
                                                $last_event_attendees=Helper::get_event_meta($data['event']->id,'last_event_attendees',true );
                                            ?>
                                            @if(!empty($last_event_attendees))
                                            <b>Attendees: </b>{{ $last_event_attendees }}<br>
                                            @endif

                                        </div>
                                        <div class="col-sm-6">
                                            Exhibitor Info: <br>
                                            <?php
                                            $exhibitor_info=Helper::get_event_meta($data['event']->id,'exhibitor_info',true );
                                            $exhibitor_info=str_replace('Exhibitor Registration','',$exhibitor_info);
                                            ?>
                                            @if(!empty($exhibitor_info))
                                            <span class="exhibitor_info">{{ $exhibitor_info }}</span>
                                            @endif
                                            <span class="exhibitor_get_quote">
                                                <a href="#" data-toggle="modal" data-target="#getquoteForm" class="btn btn-success">Get Quote</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="users">
                            <?php
                                $attendee_info=Helper::get_event_meta($data['event']->id,'attendees_info',true );
                                $attendee_info=str_replace('Attendee Registration','',$attendee_info);
                            ?>
                            @if(!empty($attendee_info))
                            <?php
                                $get_event_attendee=Helper::get_event_user($data['event']->id,'attendee');
                                //print_r($get_event_attendee); exit;

                                if(!empty($get_event_attendee)){ ?>
                                <div class="row">
                                <?php foreach($get_event_attendee as $attendee){ ?>
                                
                                <?php
                                $image=$attendee->profile_pic;
                                if(empty($image)){
                                    $image=url('uploads/profile_pics/default-profile.png');
                                } else{
                                    $image=url($attendee->profile_pic);
                                }
                                ?>
                                @if($attendee->user_type=='company')
                                    <div class="col-sm-3">
                                        <a href="{{ url('company/'.$attendee->id) }}">
                                            <div class="event_user_box">
                                                <img src="{{ $image }}" alt="">
                                                <span>{{ $attendee->name }}</span>
                                            </div>
                                        </a>
                                        
                                    </div>
                                @else
                                <div class="col-sm-3">
                                        <div class="event_user_box">
                                            <img src="{{ $image }}" alt="">
                                            <span>{{ $attendee->name }}</span>
                                        </div>
                                    </div>
                                @endif
                                <?php } ?>

                                </div>

                            <?php    }
                            ?>
                            <b>{{ $data['event']->attendees }}</b> User(s) added!<br>
                                <span>{{ $attendee_info }}</span>
                                @endif
                                <br>

                                <a href="#" data-toggle="modal" data-target="#attendeeRegister">Register</a> here.
                            </div>
                            <div role="tabpanel" class="tab-pane" id="exhibitors">
                                <?php
                                $unregister_exibitors=unserialize( $data['event']->unregister_exibitors);
                                if(!empty($unregister_exibitors)){ ?>
                                <ul class="unre_exhi_list">
                                <?php foreach($unregister_exibitors as $unregister_exibitor) { ?>
                                    <li>{{ $unregister_exibitor }}</li>
                                <?php } ?>

                                </ul>

                                <?php } ?>


                                <?php
                                $get_event_exhibitor=Helper::get_event_user($data['event']->id,'exhibitor');
                                //print_r($get_event_exhibitor); exit;

                                if(!empty($get_event_exhibitor)){ ?>
                                <div class="row">
                                <?php foreach($get_event_exhibitor as $exhibitor){ ?>
                                <?php
                                $image=$exhibitor->profile_pic;
                                if(empty($image)){
                                    $image=url('uploads/profile_pics/default-profile.png');
                                }
                                ?>
                                 @if($attendee->user_type=='company')
                                    <div class="col-sm-3">
                                        <a href="{{ url('company/'.$exhibitor->id) }}">
                                            <div class="event_user_box">
                                                <img src="{{ $image }}" alt="">
                                                <span>{{ $exhibitor->name }}</span>
                                            </div>
                                        </a>
                                        
                                    </div>
                                @else
                                <div class="col-sm-3">
                                        <div class="event_user_box">
                                            <img src="{{ $image }}" alt="">
                                            <span>{{ $exhibitor->name }}</span>
                                        </div>
                                    </div>
                                @endif

                                <?php } ?>

                                </div>

                            <?php    }
                            ?>
                                <!-- <b>{{ $data['event']->exhibitors }}</b> exhibitor(s) added! -->
                                <a href="#" data-toggle="modal" data-target="#exhibitorRegister">Register</a> here.
                            </div>
                            <div role="tabpanel" class="tab-pane" id="gallery">
                            <?php
                                $html='';
                                $get_image_gallery=unserialize($data['event']->gallery_image);
                                //print($get_image_gallery); exit;
                                if(!empty($get_image_gallery)){
                            ?>
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                
                                    <div class="row">
                                    <?php
                                    foreach ($get_image_gallery as $image) {
                                            if( !empty($image)){ ?>
                                            <a href="{{ url($image) }}" data-toggle="lightbox" data-gallery="example-gallery" class="col-sm-3 light_box_thubmnail">
                                                <img src="{{ url($image) }}" class="img-fluid">
                                            </a>
                                            <?php } ?>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                                

                            </div>
                            <div role="tabpanel" class="tab-pane" id="video">
                                <?php
                                    $get_image_gallery=Helper::get_gallery_image('event',$data['event']->id,'video');
                                ?>
                                @if($get_image_gallery)
                                    <?php
                                    foreach($get_image_gallery as $video){
                                    //$youtube_main_code_a=explode('/', $video);
                                    //print_r($youtube_main_code_a); exit;
                                    //$codecheck=$youtube_main_code_a[count($youtube_main_code_a)-1];
                                    /* if (preg_match("/watch/", $codecheck)){
                                    $y_code=str_replace('watch?v=', '',$codecheck );
                                    } else{
                                    $y_code=$codecheck;
                                    } */
                                    ?>
                                    <a href="{{ $video->image_path }}">{{ $video->image_path }}</a>
                                    <!-- <iframe width="704" height="396" src="{{ $video->image_path }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe> -->
                                    <?php } ?>
                                @endif

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Attendee register Modal -->
<div class="modal fade" id="attendeeRegister" tabindex="-1" role="dialog" aria-labelledby="attendeeRegisterLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendeeRegisterLabel">Attendees Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label> -->
                <input type="hidden" name="user_type" id="user_type" value="attendee">
                <input type="hidden" name="event_id" id="event_id" value="{{ $data['event']->id }}">

            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                <div class="col-md-6">
                    {{ Form::select('company', $data['companies'] , '',array('placeholder'=>'Choose','id'=>'company','class'=>'')) }}

                    @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>


<!-- Exhibitor register Modal -->
<div class="modal fade" id="exhibitorRegister" tabindex="-1" role="dialog" aria-labelledby="exhibitorRegisterLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exhibitorRegisterLabel">Exhibitors Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <!-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label> -->
                <input type="hidden" name="user_type" id="user_type" value="exhibitor">
                <input type="hidden" name="event_id" id="event_id" value="{{ $data['event']->id }}">

            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                <div class="col-md-6">
                    {{ Form::select('company', $data['companies'] , '',array('placeholder'=>'Choose','id'=>'company','class'=>'')) }}

                    @error('company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<!-- Get quote form -->
<div class="modal fade" id="getquoteForm" tabindex="-1" role="dialog" aria-labelledby="getquoteFormLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="getquoteFormLabel">Get Quote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="#">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mesaage') }}</label>

                <div class="col-md-6">
                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" ></textarea>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

@endsection
