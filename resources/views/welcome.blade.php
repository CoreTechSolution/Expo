@extends('layouts.app')

@section('content')

<div id="section2" class="section2">
    <div class="container">
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-10">
                <h2>FIND, ORGANIZE, PARTICIPATE AND <br>PROMOTE YOUR EVENTS</h2>
                <h6>All in one Place</h6>
            </div>
            <div class="col-xl-1"></div>
        </div>
        <div class="row forDesktop">
            <div class="col-xl-12">
                <ul>
                    <li>
                        <div class="event-icon"><img src="assets/images/find-event-icon.jpg"></div>
                        <div class="event-text">Find events, create a company calendar, andshare with coworkers</div>
                        <div class="event-links"><a href="#">Find events</a></div>
                    </li>
                    <li>
                        <div class="event-icon"><img src="assets/images/register-speakers.jpg"></div>
                        <div class="event-text">Register yourself or your executives as speakers and panelists for events</div>
                        <div class="event-links"><a href="#">Register Speaker</a></div>
                    </li>
                    <li>
                        <div class="event-icon"><img src="assets/images/register-events.jpg"></div>
                        <div class="event-text">Register your event for free and make it easier for attendees to learn and register</div>
                        <div class="event-links"><a href="#">Register Events</a></div>
                    </li>
                    <li>
                        <div class="event-icon"><img src="assets/images/sign-up-vender.jpg"></div>
                        <div class="event-text">Find local vendors for all your event needs– venues,catering, A/V, booth materials, and more</div>
                        <div class="event-links"><a href="#">Sign up as a Vendor</a></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row forMobile">
            <div class="col-xl-12">
                <ul class="bxslider_events1">
                    <li>
                        <div class="jagsslider-wrap">
                            <div class="event-icon"><img src="assets/images/find-event-icon.jpg"></div>
                            <div class="event-text">Find events, create a company calendar, andshare with coworkers</div>
                            <div class="event-links"><a href="#">Find events</a></div>
                        </div>
                    </li>
                    <li>
                        <div class="jagsslider-wrap">
                            <div class="event-icon"><img src="assets/images/register-speakers.jpg"></div>
                            <div class="event-text">Register yourself or your executives as speakers and panelists for events</div>
                            <div class="event-links"><a href="#">Register Speaker</a></div>
                        </div>
                    </li>
                    <li>
                        <div class="jagsslider-wrap">
                            <div class="event-icon"><img src="assets/images/register-events.jpg"></div>
                            <div class="event-text">Register your event for free and make it easier for attendees to learn and register</div>
                            <div class="event-links"><a href="#">Register Events</a></div>
                        </div>
                    </li>
                    <li>
                        <div class="jagsslider-wrap">
                            <div class="event-icon"><img src="assets/images/sign-up-vender.jpg"></div>
                            <div class="event-text">Find local vendors for all your event needs– venues,catering, A/V, booth materials, and more</div>
                            <div class="event-links"><a href="#">Sign up as a Vendor</a></div>
                        </div>
                    </li>
                </ul>
                <div class="bxslider_events1_pager"></div>
            </div>
        </div>
    </div>
</div>
<div class="section3">
    <div class="container">
        <div class="row">
            <div class="col-xl-10">
                <h2>Upcoming Events</h2>
                <h6>Showing events in <a href="javascript:void(0)"><span>Automotive</span></a></h6>
            </div>
            <div class="col-xl-2">
                <div class="filter">
                    <button class="btn btn-outline-primary outline-primary">Filter</button>
                </div>
            </div>
        </div>
        <div class="row forDesktop">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_1.jpg"></div>
                    <div class="matchheight">
                        <div class="event-name">The Buildings Show</div>
                        <div class="event-venue">Toronto, Canada</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_2.jpg"></div>
                    <div class="matchheight">
                        <div class="event-name">Interior Design Show Vancouver</div>
                        <div class="event-venue">Pasay, Philippines</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_3.jpg"></div>
                    <div class="matchheight">
                        <div class="event-name">Index</div>
                        <div class="event-venue">Pasay, Philippines</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_4.jpg"></div>
                    <div class="matchheight">
                        <div class="event-name">Philippine World Building & Construction Exposition</div>
                        <div class="event-venue">Paris, France</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row forDesktop">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_5.jpg"></div>
                    <div class="matchheight1">
                        <div class="event-name">Formex</div>
                        <div class="event-venue">Stockholm, Sweeden</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_6.jpg"></div>
                    <div class="matchheight1">
                        <div class="event-name">Buildex Vancouver</div>
                        <div class="event-venue">Vancouver, Canada</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_7.jpg"></div>
                    <div class="matchheight1">
                        <div class="event-name">Smart City Expo World Congress</div>
                        <div class="event-venue">Barcelona, Spain</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="event-wrapper">
                    <div class="event-img"><img src="assets/images/event_8.jpg"></div>
                    <div class="matchheight1">
                        <div class="event-name">The Buildings Show</div>
                        <div class="event-venue">Toronto, Canada</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row forMobile">
            <div class="col-xl-12">
                <div class="bxslider_events">
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_1.jpg"></div>
                                <div class="matchheight">
                                    <div class="event-name">The Buildings Show</div>
                                    <div class="event-venue">Toronto, Canada</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_2.jpg"></div>
                                <div class="matchheight">
                                    <div class="event-name">Interior Design Show Vancouver</div>
                                    <div class="event-venue">Pasay, Philippines</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_3.jpg"></div>
                                <div class="matchheight">
                                    <div class="event-name">Index</div>
                                    <div class="event-venue">Pasay, Philippines</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_4.jpg"></div>
                                <div class="matchheight">
                                    <div class="event-name">Philippine World Building & Construction Exposition</div>
                                    <div class="event-venue">Paris, France</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_5.jpg"></div>
                                <div class="matchheight1">
                                    <div class="event-name">Formex</div>
                                    <div class="event-venue">Stockholm, Sweeden</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_6.jpg"></div>
                                <div class="matchheight1">
                                    <div class="event-name">Buildex Vancouver</div>
                                    <div class="event-venue">Vancouver, Canada</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_7.jpg"></div>
                                <div class="matchheight1">
                                    <div class="event-name">Smart City Expo World Congress</div>
                                    <div class="event-venue">Barcelona, Spain</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="event-wrapper">
                                <div class="event-img"><img src="assets/images/event_8.jpg"></div>
                                <div class="matchheight1">
                                    <div class="event-name">The Buildings Show</div>
                                    <div class="event-venue">Toronto, Canada</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bxslider_events_pager"></div>
            </div>
        </div>
    </div>
</div>
<div class="section4">
    <!--<div class="section4img"></div>-->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h2>SPEAKERS IN DEMAND</h2>
                <h6>Find speakers for your event or List yourself or someone else</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="speaker-wrapper">
                    <div class="row">
                        <div class="col-xl-10">
                            <h6>Showing popular speakers in <a href="javascript:void(0);"><span>IT & Technology</span></a></h6>
                        </div>
                        <div class="col-xl-2">
                            <div class="filter">
                                <button class="btn btn-outline-primary outline-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="row forDesktop">
                        <div class="col-xl-12">
                            <ul>
                                <li>
                                    <div class="speaker-img"><img src="assets/images/speaker_1.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                                    <div class="speaker-name">Eugene Pozniak</div>
                                    <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                </li>
                                <li>
                                    <div class="speaker-img"><img src="assets/images/speaker_2.jpg"></div>
                                    <div class="speaker-name">Eugene Pozniak</div>
                                    <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                </li>
                                <li>
                                    <div class="speaker-img"><img src="assets/images/speaker_3.jpg"></div>
                                    <div class="speaker-name">Eugene Pozniak</div>
                                    <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                </li>
                                <li>
                                    <div class="speaker-img"><img src="assets/images/speaker_4.jpg"></div>
                                    <div class="speaker-name">Eugene Pozniak</div>
                                    <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                </li>
                                <li>
                                    <div class="speaker-img"><img src="assets/images/speaker_5.jpg"></div>
                                    <div class="speaker-name">Eugene Pozniak</div>
                                    <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row forMobile">
                        <div class="col-xl-12">
                            <ul class="bxslider_speakers">
                                <li>
                                    <div class="jagsslider-wrap">
                                        <div class="speaker-img"><img src="assets/images/speaker_1.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                                        <div class="speaker-name">Eugene Pozniak</div>
                                        <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="jagsslider-wrap">
                                        <div class="speaker-img"><img src="assets/images/speaker_2.jpg"></div>
                                        <div class="speaker-name">Eugene Pozniak</div>
                                        <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="jagsslider-wrap">
                                        <div class="speaker-img"><img src="assets/images/speaker_3.jpg"></div>
                                        <div class="speaker-name">Eugene Pozniak</div>
                                        <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="jagsslider-wrap">
                                        <div class="speaker-img"><img src="assets/images/speaker_4.jpg"></div>
                                        <div class="speaker-name">Eugene Pozniak</div>
                                        <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="jagsslider-wrap">
                                        <div class="speaker-img"><img src="assets/images/speaker_5.jpg"></div>
                                        <div class="speaker-name">Eugene Pozniak</div>
                                        <div class="speaker-designation">European CME <br>Specialist at Global </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="bxslider_speakers_pager"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-10">
                        <h2>Showing popular vendors in <a href="javascript:void(0);"><span>Las Vegas</span></a></h2>
                        <!--<h6>Showing popular vendors in <span>Las Vegas</span></h6>-->
                    </div>
                    <div class="col-xl-2">
                        <div class="filter">
                            <a href="{{ url('vendors') }}" class="btn btn-outline-primary outline-primary">View All</a>
                        </div>
                    </div>
                </div>
                @if(!empty($data['vendors']))
                <div class="row forDesktop">
                    @foreach($data['vendors'] as $vendor)
                    <?php
                        $city_name=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($vendor->id,'service_area',true),'city_name');
                        $city_slug=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($vendor->id,'service_area',true),'slug');
                        $state=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($vendor->id,'service_area',true),'state');
                        $cat_slug=Helper::get_returnvaluefield('vendor_categories','id',Helper::get_user_meta($vendor->id,'vendor_category',true),'slug');
                        ?>
                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        
                        <div class="vendors-wrapper">
                            <a href="{{ url('vendor/'.$city_slug.'/'.$cat_slug.'/'.$vendor->id) }}">
                                <div class="vendor-img"><img src="{{ url('uploads/profile_pics/'.$vendor->profile_pic) }}"></div>
                                <div class="text1">{{ $vendor->name }}</div>
                                <div class="text2">{{ str_limit(Helper::get_user_meta($vendor->id,'about',true),100,'...') }}</div>
                                <div class="text3">{{ $city_name }}, {{ $state }}</div>
                            </a>
                        </div>
                        
                        
                    </div>
                    @endforeach
                </div>
                
                @endif
                <div class="row forMobile">
                    <div class="col-xl-12">
                        <div class="bxslider_vendors">
                            <div>
                                <div class="jagsslider-wrap">
                                    <div class="vendors-wrapper">
                                        <div class="vendor-img"><img src="assets/images/vendor_1.jpg"></div>
                                        <div class="text1">Light Middle East</div>
                                        <div class="text2">Dubai, UAE</div>
                                        <div class="text3">Dubai International Convention & Exhibition Centre</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="jagsslider-wrap">
                                    <div class="vendors-wrapper">
                                        <div class="vendor-img"><img src="assets/images/vendor_2.jpg"></div>
                                        <div class="text1">Decorex Joburg</div>
                                        <div class="text2">Johannesburg, South Africa</div>
                                        <div class="text3">Gallagher Convention Centre</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="jagsslider-wrap">
                                    <div class="vendors-wrapper">
                                        <div class="vendor-img"><img src="assets/images/vendor_3.jpg"></div>
                                        <div class="text1">HOMEDEC Kuala Lumpur</div>
                                        <div class="text2">Kuala Lumpur, Malayasia</div>
                                        <div class="text3">Kuala Lumpur Convention Centre</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="jagsslider-wrap">
                                    <div class="vendors-wrapper">
                                        <div class="vendor-img"><img src="assets/images/vendor_4.jpg"></div>
                                        <div class="text1">The Great Big Home + Garden Show</div>
                                        <div class="text2">Cleveland, USA</div>
                                        <div class="text3">I-X Center</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="jagsslider-wrap">
                                    <div class="vendors-wrapper">
                                        <div class="vendor-img"><img src="assets/images/vendor_5.jpg"></div>
                                        <div class="text1">Concrete Show India</div>
                                        <div class="text2">Mumbai, India</div>
                                        <div class="text3">Bombay Exhibition Centre (BEC)</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="jagsslider-wrap">
                                    <div class="vendors-wrapper">
                                        <div class="vendor-img"><img src="assets/images/vendor_6.jpg"></div>
                                        <div class="text1">KZN Construction Expo</div>
                                        <div class="text2">Durban, South Africa</div>
                                        <div class="text3">Durban Exhibition Centre</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bxslider_vendors_pager"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section6">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h2>EXPLORE THROUGH MEDIA</h2>
                <h6>Showing Event Recaps in <a href="javascript:void(0)"><span style="border-bottom: 2px solid #e51b32;">Toys</span></a></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-4"><div class="mediaWrap"><img src="assets/images/video.png"></div></div>
            <div class="col-xl-4 col-lg-4"><div class="mediaWrap"><img src="assets/images/photo.png"></div></div>
            <div class="col-xl-4 col-lg-4"><div class="mediaWrap"><img src="assets/images/social-media.png"></div></div>
        </div>
        <div class="row row1">
            <div class="col-xl-4 col-lg-4"><div class="bluedot"></div></div>
            <div class="col-xl-4 col-lg-4"><div class="graydot"></div></div>
            <div class="col-xl-4 col-lg-4"><div class="graydot"></div></div>
        </div>
        <div class="row forDesktop">
            <div class="col-xl-4 col-lg-4">
                <div class="media-img"><img src="assets/images/media_1.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                <div class="text1">The Great Big Home + Garden Show</div>
                <div class="text2">Cleveland, USA</div>
                <div class="text3">I-X Center</div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="media-img"><img src="assets/images/media_2.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                <div class="text1">The Great Big Home + Garden Show</div>
                <div class="text2">Cleveland, USA</div>
                <div class="text3">I-X Center</div>
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="media-img"><img src="assets/images/media_3.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                <div class="text1">The Great Big Home + Garden Show</div>
                <div class="text2">Cleveland, USA</div>
                <div class="text3">I-X Center</div>
            </div>
        </div>
        <div class="row forMobile">
            <div class="col-xl-12">
                <div class="bxslider_media">
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="media-img"><img src="assets/images/media_1.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                            <div class="text1">The Great Big Home + Garden Show</div>
                            <div class="text2">Cleveland, USA</div>
                            <div class="text3">I-X Center</div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="media-img"><img src="assets/images/media_2.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                            <div class="text1">The Great Big Home + Garden Show</div>
                            <div class="text2">Cleveland, USA</div>
                            <div class="text3">I-X Center</div>
                        </div>
                    </div>
                    <div>
                        <div class="jagsslider-wrap">
                            <div class="media-img"><img src="assets/images/media_3.jpg"><div class="play-btn"><img src="assets/images/play-btn.png"></div></div>
                            <div class="text1">The Great Big Home + Garden Show</div>
                            <div class="text2">Cleveland, USA</div>
                            <div class="text3">I-X Center</div>
                        </div>
                    </div>
                </div>
                <div class="bxslider_media_pager"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div style="text-align: center;">
                    <a href="#" class="btn btn-primary custom-btn-primary">View More</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection