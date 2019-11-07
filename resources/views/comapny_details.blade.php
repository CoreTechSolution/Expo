@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        <div class="row">

            <!-- <div class="col-lg-3">
               @include('template-part.event_sidebar')
               
           </div> -->
           <?php
           
            /* $vendor_category=Helper::get_returnvaluefield('vendor_categories','id',Helper::get_user_meta($data['vendor']->id,'vendor_category',true),'vendor_category_name');

            $service_area=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($data['vendor']->id,'service_area',true),'city_name');
            $company__detals=Helper::get_user_by('id',$data['vendor']->company);
            $products=Helper::get_products_by_user($data['vendor']->id);
            $services=Helper::get_services_by_user($data['vendor']->id); */
            if(!empty($data['company']->profile_pic)){
                $bg_image=url($data['company']->profile_pic);
            } else{
                $bg_image=url('uploads/no_images.png');
            }
            
           ?>
           <div class="col-lg-12">
            <div class="page_content">
                <div class="bg-image" style="background-image: url(
                '{{ $bg_image }}'); background-size: cover; background-position: center;"></div>

                <div class="bg-text">
                  <div class="vendor_details_profile_img" style="background: url({{ $bg_image }}); background-size: cover; background-position: center;">
                      
                  </div>
                  <div class="vendor_bg_detail_text">
                      <h1>{{ $data['company']->name }}</h1>
                      <p>{{ $data['company']->email }}</p>
                     
                  </div>
                  
                </div>
                <div class="breadcrumbs_div">
                    <ul class="breadcrumbs">
                        <li class="first"><a href="{{ url('/') }}" class="fa fa-home"></a></li>
                        @if(!empty(Request::segment(1)))
                            @if(empty(Request::segment(2)))
                                <li class="last active"><a href="javascript:void(0)">{{ Request::segment(1)}}</a></li>
                            @else
                                <li><a href="{{ url('companies') }}">{{ Request::segment(1)}}</a></li>
                            @endif
                        @endif
                        @if(!empty(Request::segment(2)))
                            @if(empty(Request::segment(3)))
                                <li class="last active"><a href="javascript:void(0)">{{ Helper::get_returnvaluefield('users','id',Request::segment(2),'name')}}</a></li>
                            @else
                                <li><a href="{{ url('companies/'.Request::segment(2)) }}">{{ Request::segment(2)}}</a></li>
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
              
                <div class="vendor_page_body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="section_text">
                                <h2>About</h2>
                                {{ Helper::get_user_meta($data['company']->id,'description',true) }}    
                            </div>

                            <?php
                                $gallery_images=array();
                                $gallery_images=Helper::get_user_meta($data['company']->id,'gallaries',true);
                                if(!empty($gallery_images))
                                $gallery_images=unserialize($gallery_images);
                                //print_r
                            ?>
                            @if(!empty($gallery_images))
                            <div class="section_text">
                                <h2>Gallery</h2>
                                <ul class="vendors_gallery_list parent-image-container">
                                @foreach($gallery_images as $gallery)
                                    @if(!empty($gallery))
                                    <li><a href="{{ url($gallery) }}"><img src="{{ url($gallery) }}" alt=""></a></li>
                                    @endif
                                @endforeach
                                </ul>
                            </div>
                            @endif

                            @php
                                //$events=Helper::get_event_by_user()
                            @endphp

                            <div class="section_text event_list_tab">
                                <h2>Event Calendar</h2>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link mbr-fonts-style display-7 active" role="tab" data-toggle="tab" href="#sponsor" aria-expanded="true">
                                            Sponsor
                                        </a></li>
                                    <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab" data-toggle="tab" href="#exibitor" aria-expanded="false">
                                            Exhibitor
                                        </a></li>
                                    <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab" data-toggle="tab" href="#attendee" aria-expanded="false">
                                            Attendee
                                        </a></li>
                                    <li class="nav-item"><a class="nav-link mbr-fonts-style display-7" role="tab" data-toggle="tab" href="#speaker" aria-expanded="false">
                                            Speaker
                                        </a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="sponsor" class="tab-pane in active" role="tabpanel" aria-expanded="true">
                                        @php
                                            $sponsors=Helper::get_event_by_user($data['company']->id,'sponsor');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(!empty($sponsors))
                                                    <table class="table table-striped table-responsive ">
                                                        <tbody>
                                                            @foreach($sponsors as $sponsor)
                                                            <tr>
                                                                <td style="width:20%;text-align:right">{{ Helper::date_formate_change($sponsor->event_date_start,'d') }} - {{ Helper::date_formate_change($sponsor->event_date_end,'d M') }}<small class="text-muted block">{{ Helper::date_formate_change($sponsor->event_date_end,'Y') }}</small></td>
                                                                <td style="width:60%;"> <a href="{{ url('event-details/'.$sponsor->slug) }}"><strong>{{ $sponsor->event_title }}</strong></a>
                                                                    <br><small class="text-success">SPONSOR</small><small class="text-muted">  <!-- 1491 Interested | 570 Going --></small></td>
                                                                <td style="width:20%;"><small class="block">{{ $sponsor->event_country }}</small></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="mbr-text py-5 mbr-fonts-style display-7">
                                                        No Event found!
                                                    </p>
                                                @endif
                                                
                                            </div>
                                        </div>

                                    </div>
                                    <div id="exibitor" class="tab-pane" role="tabpanel" aria-expanded="false">
                                        @php
                                            $exhibitors=Helper::get_event_by_user($data['company']->id,'exhibitor');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(!empty($exhibitors))
                                                    <table class="table table-striped table-responsive ">
                                                        <tbody>
                                                            @foreach($exhibitors as $exhibitor)
                                                            <tr>
                                                                <td style="width:20%;text-align:right">{{ Helper::date_formate_change($exhibitor->event_date_start,'d') }} - {{ Helper::date_formate_change($exhibitor->event_date_end,'d M') }}<small class="text-muted block">{{ Helper::date_formate_change($exhibitor->event_date_end,'Y') }}</small></td>
                                                                <td style="width:60%;"> <a href="{{ url('event-details/'.$exhibitor->slug) }}"><strong>{{ $exhibitor->event_title }}</strong></a>
                                                                    <br><small class="text-success">EXHIBITOR</small><small class="text-muted">  <!-- 1491 Interested | 570 Going --></small></td>
                                                                <td style="width:20%;"><small class="block">{{ $exhibitor->event_country }}</small></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="mbr-text py-5 mbr-fonts-style display-7">
                                                        No Event found!
                                                    </p>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="attendee" class="tab-pane" role="tabpanel" aria-expanded="false">
                                        @php
                                            $attendees=Helper::get_event_by_user($data['company']->id,'attendee');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(!empty($attendees))
                                                    <table class="table table-striped table-responsive ">
                                                        <tbody>
                                                            @foreach($attendees as $attendee)
                                                            <tr>
                                                                <td style="width:20%;text-align:right">{{ Helper::date_formate_change($attendee->event_date_start,'d') }} - {{ Helper::date_formate_change($attendee->event_date_end,'d M') }}<small class="text-muted block">{{ Helper::date_formate_change($attendee->event_date_end,'Y') }}</small></td>
                                                                <td style="width:60%;"> <a href="{{ url('event-details/'.$attendee->slug) }}"><strong>{{ $attendee->event_title }}</strong></a>
                                                                    <br><small class="text-success">ATTENDEE</small><small class="text-muted">  <!-- 1491 Interested | 570 Going --></small></td>
                                                                <td style="width:20%;"><small class="block">{{ $attendee->event_country }}</small></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="mbr-text py-5 mbr-fonts-style display-7">
                                                        No Event found!
                                                    </p>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="speaker" class="tab-pane" role="tabpanel" aria-expanded="false">
                                        @php
                                            $speakers=Helper::get_event_by_user($data['company']->id,'speaker');
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(!empty($speakers))
                                                    <table class="table table-striped table-responsive ">
                                                        <tbody>
                                                            @foreach($speakers as $speaker)
                                                            <tr>
                                                                <td style="width:20%;text-align:right">{{ Helper::date_formate_change($speaker->event_date_start,'d') }} - {{ Helper::date_formate_change($speaker->event_date_end,'d M') }}<small class="text-muted block">{{ Helper::date_formate_change($speaker->event_date_end,'Y') }}</small></td>
                                                                <td style="width:60%;"> <a href="{{ url('event-details/'.$speaker->slug) }}"><strong>{{ $speaker->event_title }}</strong></a>
                                                                    <br><small class="text-success">SPEAKER</small><small class="text-muted">  <!-- 1491 Interested | 570 Going --></small></td>
                                                                <td style="width:20%;"><small class="block">{{ $speaker->event_country }}</small></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <p class="mbr-text py-5 mbr-fonts-style display-7">
                                                        No Event found!
                                                    </p>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                        </div>

                         <?php //print_r($data['company']); exit; ?>
                        
                    </div>
                    
                    

              </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="company_details" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="companyModalLabel">Company Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="model_body_content">
       

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection