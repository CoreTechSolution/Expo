<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php if(!empty($data['page_title'])){
        $page_title=config('app.name', 'Laravel').' | '.$data['page_title'];
    } else{
        $page_title=config('app.name', 'Laravel');
    }
    ?>
    <title>{{  $page_title }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('assets/css/jquery.bxslider.min.css') }}">
    <link href="{{ url('assets/css/fontawesome/css/all.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/fullcalendar/fullcalendar.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/dropzone/css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/magnific-popup/magnific-popup.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">


    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>
    <?php if(Request::is("/")) { ?>
        <div class="section1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-sm navbar-dark">
                            <!-- Brand -->
                            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('assets/images/logo.png') }}"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Links -->
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('events') }}">Events</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Add Events</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Speakers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Your Calendar</a>
                                    </li>
                                    @guest
                                    <li class="nav-item">
                                        <a class="nav-link join-login" href="{{ route('login') }}">Login</a>
                                    </li>
                                    @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('dashboard') }}">My Account</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="banner-title">SEARCH EVENTS, TRADESHOWS <br>& CONFERENCES</div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2"></div>
                <div class="col-xl-8 col-lg-8 col-md-8">
                    <form method="get" action="">
                        <div class="row">
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="" placeholder="Search by event name, industry, or location">
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2">
                                <div class="form-group">
                                    <input type="submit" name="" value="SEARCH" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2"></div>
            </div>
            <div class="row forMobile">
                <div class="col-xl-12">
                    <div class="faicon">
                        <a href="#section2" style="color: #ffffff;">
                            <div class="arrow bounce"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div class="section_header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <nav class="navbar navbar-expand-sm navbar-dark">
                        <!-- Brand -->
                        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('assets/images/logo.png') }}"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Links -->
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('events') }}">Events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Add Events</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Speakers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Your Calendar</a>
                                </li>
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link join-login" href="{{ route('login') }}">Login</a>
                                </li>
                                @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('my-account') }}">My Account</a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php } ?>
@yield('content')

<div class="section7">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h2>Event Industries</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul>
                    <li><a href="#">Agriculture & Forestry</a></li>
                    <li><a href="#">Animals & Pets</a></li>
                    <li><a href="#">Apparel & Clothing</a></li>
                    <li><a href="#">Arts & Crafts</a></li>
                    <li><a href="#">Auto & Automotive</a></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li><a href="#">Baby, Kids & Maternity</a></li>
                    <li><a href="#">Banking & Finance</a></li>
                    <li><a href="#">Building & Construction</a></li>
                    <li><a href="#">Business Services</a></li>
                    <li><a href="#">Education & Training</a></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li><a href="#">Electric & Electronics</a></li>
                    <li><a href="#">Entertainment & Media</a></li>
                    <li><a href="#">Environment & Waste</a></li>
                    <li><a href="#">Fashion & Beauty</a></li>
                    <li><a href="#">Food & Beverages</a></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li><a href="#">Home & Office</a></li>
                    <li><a href="#">Hospitality</a></li>
                    <li><a href="#">IT & Technology</a></li>
                    <li><a href="#">Industrial Engineering</a></li>
                    <li><a href="#">Logistics & Transportation</a></li>
                </ul>
            </div>
            <div class="col">
                <ul>
                    <li><a href="#">Medical & Pharma</a></li>
                    <li><a href="#">Miscellaneous</a></li>
                    <li><a href="#">Packing & Packaging</a></li>
                    <li><a href="#">Power & Energy</a></li>
                    <li><a href="#">Science & Research</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-12">
                <div class="footer-logo"><img src="{{ url('assets/images/footer-logo.png') }}"></div>
                <div class="footer-links">
                    <ul>
                        <li><a href="#">Our Story</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="copyright">© expodisco 2019</div>
            </div>
        </div>
    </div>
</div>
<!-- *****************Login modal****************** -->
<div class="modal fade login_popup" id="login_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body mx-3">
    <div id="popup_login_message">

    </div>

    <div class="md-form mb-4">
        <input type="hidden" name="popup_current_url" id="popup_current_url">
        <label data-error="wrong" data-success="right" for="popup_login_email">Email <span class="required text-danger">*</span></label>
      <input type="email" id="popup_login_email" class="form-control validate">

  </div>

  <div class="md-form mb-4">
     <label data-error="wrong" data-success="right" for="popup_login_password">Password <span class="required text-danger">*</span></label>
      <input type="password" id="popup_login_password" class="form-control validate">

  </div>

</div>
<div class="modal-footer d-flex justify-content-center">
    <button class="btn btn-info" id="popup_login_btn">Login</button>
<a class="btn btn-default" id="popup_register_btn" href="{{ url('register') }}">Register</a>
</div>
</div>
</div>
</div>
<!-- *****************Login modal end****************** -->
<!-- *****************Success modal****************** -->
<div class="modal fade" id="success_popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Success</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="responce_msg"></div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- *****************Success modal end****************** -->

<!-- *****************Success modal****************** -->
<div class="modal fade" id="error_popup" tabindex="-1" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Error</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="responce_msg"></div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<!-- *****************Success modal end****************** -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script>
    var base_url='<?php echo url("/"); ?>';
    //alert(base_url);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.2/jquery.matchHeight-min.js"></script>
<!-- Vendor JS -->
<script src="{{url('assets/vendor/fullcalendar/lib/moment.min.js') }}"></script>
<script src="{{url('assets/vendor/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{url('assets/vendor/dropzone/dropzone.js') }}"></script>
<script src="{{url('assets/vendor/magnific-popup/magnific-popup.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha256-bmXHkMKAxMZgr2EehOetiN/paT9LXp0KKAKnLpYlHwE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

<script src="{{url('assets/js/jquery.bxslider.min.js') }}"></script>
<script src="{{url('assets/js/theme_script.js') }}"></script>
<script>
    $(function() {
        $('.event-wrapper').matchHeight({
            property: 'min-height'
        });
        $('.bxslider_events1').bxSlider({
            pagerCustom: '.bxslider_events1_pager',
            auto: true,
            nextText: '<i class="fas fa-angle-right"></i>',
            prevText: '<i class="fas fa-angle-left"></i>'
        });
        $('.bxslider_events').bxSlider({
            pagerCustom: '.bxslider_events_pager',
            auto: true,
            nextText: '<i class="fas fa-angle-right"></i>',
            prevText: '<i class="fas fa-angle-left"></i>'
        });
        $('.bxslider_speakers').bxSlider({
            pagerCustom: '.bxslider_speakers_pager',
            auto: true,
            nextText: '<i class="fas fa-angle-right"></i>',
            prevText: '<i class="fas fa-angle-left"></i>'
        });
        $('.bxslider_vendors').bxSlider({
            pagerCustom: '.bxslider_vendors_pager',
            auto: true,
            nextText: '<i class="fas fa-angle-right"></i>',
            prevText: '<i class="fas fa-angle-left"></i>'
        });
        $('.bxslider_media').bxSlider({
            pagerCustom: '.bxslider_media_pager',
            auto: true,
            nextText: '<i class="fas fa-angle-right"></i>',
            prevText: '<i class="fas fa-angle-left"></i>'
        });
        $(".faicon a").click(function(event) {
            event.preventDefault();
            $("html, body").animate({ scrollTop: 500 }, "slow");
            return false;
        });
    });
</script>

</body>
</html>
