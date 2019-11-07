@extends('layouts.app')

@section('content')


<div class="section5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-10">
                        <h2 class="section_header1">{{ $data['page_title'] }}</h2>
                        <div class="breadcrumbs_div">
                            <ul class="breadcrumbs">
                                <li class="first"><a href="{{ url('/') }}" class="fa fa-home"></a></li>
                                @if(!empty(Request::segment(1)))
                                    @if(empty(Request::segment(2)))
                                        <li class="last active"><a href="javascript:void(0)">{{ Request::segment(1)}}</a></li>
                                    @else
                                        <li><a href="{{ url('vendors') }}">{{ Request::segment(1)}}</a></li>
                                    @endif
                                @endif
                                @if(!empty(Request::segment(2)))
                                    @if(empty(Request::segment(3)))
                                        <li class="last active"><a href="javascript:void(0)">{{ Request::segment(2)}}</a></li>
                                    @else
                                        <li><a href="{{ url('vendors/'.Request::segment(2)) }}">{{ Request::segment(2)}}</a></li>
                                    @endif
                                @endif
                                @if(!empty(Request::segment(3)))
                                    @if(empty(Request::segment(4)))
                                        <li class="last active"><a href="javascript:void(0)">{{ Request::segment(3)}}</a></li>
                                    @else
                                        <li><a href="{{ url('vendors/'.Request::segment(2).'/'.Request::segment(3)) }}">{{ Request::segment(3)}}</a></li>
                                    @endif
                                @endif
                               
                                
                            </ul>
                        </div>
                        
                    </div>
                </div>
                <?php
                    ///print_r($data['companies'])
                ?>
                @if(!empty($data['companies']))
                <div class="row forDesktop">
                    @foreach($data['companies'] as $vendor)
                    <?php
                    $city_name=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($vendor->id,'service_area',true),'city_name');
                    $city_slug=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($vendor->id,'service_area',true),'slug');
                    $state=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($vendor->id,'service_area',true),'state');
                    $cat_slug=Helper::get_returnvaluefield('vendor_categories','id',Helper::get_user_meta($vendor->id,'vendor_category',true),'slug');
                    if(!empty($vendor->profile_pic)){
                        $bg_image=url($vendor->profile_pic);
                    } else{
                        $bg_image=url('uploads/no_images.png');
                    }
                    ?>
                    <div class="col-xl-4 col-lg-4 col-sm-6">

                        <div class="vendors-wrapper">
                            <a href="{{ url('company/'.$vendor->id) }}">
                                <div class="vendor-img"><img src="{{  $bg_image }}"></div>
                                <div class="text1">{{ $vendor->name }}</div>
                                <div class="text2">{{ str_limit(Helper::get_user_meta($vendor->id,'about',true),100,'...') }}</div>
                                <div class="text3">{{ $city_name }}, {{ $state }}</div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="pagination_lonk_div">
                    {{ $data['companies']->links() }}
                </div>
                @endif
                <!-- <div class="row forMobile">
                    <div class="col-xl-12">
                        <div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" aria-live="polite" style="width: 100%; overflow: hidden; position: relative; height: 0px;"><div class="bxslider_vendors" style="width: 6215%; position: relative; transition-duration: 0s; transform: translate3d(0px, 0px, 0px);"><div style="float: left; list-style: outside none none; position: relative; width: 0px;" class="bx-clone" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_6.jpg"></div>
                                    <div class="text1">KZN Construction Expo</div>
                                    <div class="text2">Durban, South Africa</div>
                                    <div class="text3">Durban Exhibition Centre</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_1.jpg"></div>
                                    <div class="text1">Light Middle East</div>
                                    <div class="text2">Dubai, UAE</div>
                                    <div class="text3">Dubai International Convention &amp; Exhibition Centre</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_2.jpg"></div>
                                    <div class="text1">Decorex Joburg</div>
                                    <div class="text2">Johannesburg, South Africa</div>
                                    <div class="text3">Gallagher Convention Centre</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_3.jpg"></div>
                                    <div class="text1">HOMEDEC Kuala Lumpur</div>
                                    <div class="text2">Kuala Lumpur, Malayasia</div>
                                    <div class="text3">Kuala Lumpur Convention Centre</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_4.jpg"></div>
                                    <div class="text1">The Great Big Home + Garden Show</div>
                                    <div class="text2">Cleveland, USA</div>
                                    <div class="text3">I-X Center</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_5.jpg"></div>
                                    <div class="text1">Concrete Show India</div>
                                    <div class="text2">Mumbai, India</div>
                                    <div class="text3">Bombay Exhibition Centre (BEC)</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" aria-hidden="false">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_6.jpg"></div>
                                    <div class="text1">KZN Construction Expo</div>
                                    <div class="text2">Durban, South Africa</div>
                                    <div class="text3">Durban Exhibition Centre</div>
                                </div>
                            </div>
                        </div>
                        <div style="float: left; list-style: outside none none; position: relative; width: 0px;" class="bx-clone" aria-hidden="true">
                            <div class="jagsslider-wrap">
                                <div class="vendors-wrapper">
                                    <div class="vendor-img"><img src="assets/images/vendor_1.jpg"></div>
                                    <div class="text1">Light Middle East</div>
                                    <div class="text2">Dubai, UAE</div>
                                    <div class="text3">Dubai International Convention &amp; Exhibition Centre</div>
                                </div>
                            </div>
                        </div></div></div><div class="bx-controls bx-has-controls-direction"><div class="bx-controls-direction"><a class="bx-prev" href=""><i class="fas fa-angle-left"></i></a><a class="bx-next" href=""><i class="fas fa-angle-right"></i></a></div></div></div>
                        <div class="bxslider_vendors_pager"></div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>


@endsection