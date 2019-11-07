@extends('layouts.app')

@section('content')

<div class="section">
    <div class="container">
        <div class="row">

            <!-- <div class="col-lg-3">
               @include('template-part.event_sidebar')
               
           </div> -->
           <?php
            $vendor_category=Helper::get_returnvaluefield('vendor_categories','id',Helper::get_user_meta($data['vendor']->id,'vendor_category',true),'vendor_category_name');

            $service_area=Helper::get_returnvaluefield('cities','id',Helper::get_user_meta($data['vendor']->id,'service_area',true),'city_name');
            $company__detals=Helper::get_user_by('id',$data['vendor']->company);
            $products=Helper::get_products_by_user($data['vendor']->id);
            $services=Helper::get_services_by_user($data['vendor']->id);
           ?>
           <div class="col-lg-12">
            <div class="page_content">
                <div class="bg-image" style="background-image: url(
                '{{ url('uploads/profile_pics/'.$data['vendor']->profile_pic) }}'); background-size: cover; background-position: center;"></div>

                <div class="bg-text">
                  <div class="vendor_details_profile_img" style="background: url({{ url('uploads/profile_pics/'.$data['vendor']->profile_pic) }});">
                      
                  </div>
                  <div class="vendor_bg_detail_text">
                      <h1>{{ $data['vendor']->name }}</h1>
                      <p>{{ $vendor_category }}</p>
                      <p><i class="fas fa-map-marker-alt"></i> Service Area: {{ $service_area }}</p>
                  </div>
                  
                </div>
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
               
                <div class="vendor_page_body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="section_text">
                                <h2>About</h2>
                                {{ Helper::get_user_meta($data['vendor']->id,'about',true) }}    
                            </div>
                            <div class="section_text">
                                <h2>Company</h2>
                                <a href="javascript:void(0);" class="vendor_details_company_btn" company_id="{{ $company__detals->id }}">{{ $company__detals->name }} </a>   
                            </div>
                            @php
                                $products=Helper::get_user_meta($data['vendor']->id,'products',true);
                                if(!empty($products))
                                    $products=explode(',',$products);
                            @endphp
                            @if(!empty($products))
                            <div class="section_text">
                                <h2>Products</h2>
                                <ul class="vendors_product_list">
                                @foreach($products as $product)
                                    <li>{{ $product }}</li>
                                @endforeach
                                </ul>
                            </div>
                            @endif

                            @php
                                $services=Helper::get_user_meta($data['vendor']->id,'services',true);
                                if(!empty($services))
                                    $services=explode(',',$services);
                            @endphp
                            @if(!empty($services))
                            <div class="section_text">
                                <h2>Services</h2>
                                <ul class="vendors_product_list">
                                @foreach($services as $service)
                                    <li>{{ $service }}</li>
                                @endforeach
                                </ul>
                                
                            </div>
                            @endif

                            <?php
                                $gallery_images=array();
                                $gallery_images=Helper::get_user_meta($data['vendor']->id,'gallery',true);
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
                            <?php
                                $testimonials=Helper::get_vendor_testimonials($data['vendor']->id);
                            ?>
                            @if(!empty($testimonials))
                            <?php
                                
                            ?>
                            <div class="section_text">
                                <h2>Testimonials</h2>
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel indicators -->
                                    
                                    <!-- Wrapper for carousel items -->
                                    <div class="carousel-inner">
                                        <?php $count=0; ?>
                                        @foreach($testimonials as $testimonial)
                                        <?php
                                            if($count==0){
                                                $class='active';
                                            } else{
                                                $class='';
                                            }
                                        ?>
                                            <div class="item carousel-item {{ $class }}">
                                                <div class="img-box"><img src="{{ url($testimonial->user_image) }}" alt=""></div>
                                                <p class="testimonial">{{ url($testimonial->content) }}</p>
                                                <p class="overview"><b>{{ $testimonial->user_name }}</b></p>
                                            </div>
                                            <?php $count++; ?>
                                        @endforeach
                                    </div>
                                    <!-- Carousel controls -->
                                    <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            @endif

                        </div>
                        <div class="col-lg-4">
                            <div class="vendor_contact_form">
                                <h2>Contact Vendor</h2>
                                <!-- <form action="">
                                    
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        
                                        <input type="submit" name="submit" velue="Submit" class="btn btn-success">
                                    </div>
                                </form> -->
                                <form action="">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" ><i class="fas fa-user"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="Name" required><span class="required-text">*</span>
                                          
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" ><i class="fas fa-envelope"></i></span>
                                          </div>
                                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" required><span class="required-text">*</span>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="service_type" class="col-sm-3">Type </label>
                                                <div class="col-sm-9">
                                                {{ Form::select('service_type', array('products'=>'Products','services'=>'Services'),'',array('id'=>'service_type','required'=>'true','users_id'=>$data['vendor']->id)) }}
                                                <span class="required-text">*</span>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <div class="row services_drop_create">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" ><i class="fas fa-mobile-alt"></i></span>
                                          </div>
                                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" ><i class="fas fa-sticky-note"></i></span>
                                          </div>
                                          <textarea class="form-control" id="message" name="message" placeholder="Message" required></textarea>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" name="submit" velue="Submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
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