<!doctype html>
<html class="fixed">
<head>

  <!-- Basic -->
  <meta charset="UTF-8">
    <?php
        if(!empty($data['page_title'])){
            $title=$data['page_title'];

        } else{
            $title='Dashboard';
        }
    ?>
  <title>{{ $title }} | Expodisco Admin</title>
  <meta name="keywords" content="HTML5 Admin Template" />
  <meta name="description" content="Porto Admin - Responsive HTML5 Template">
  <meta name="author" content="okler.net">

  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!-- Web Fonts  -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap/css/bootstrap.css') }}" />

  <link rel="stylesheet" href="{{ url('admin/assets/vendor/font-awesome/css/font-awesome.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/magnific-popup/magnific-popup.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap-datepicker/css/datepicker3.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/sweetalert2/sweetalert2.min.css') }}" />

  <!-- Specific Page Vendor CSS -->
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css') }}" />
  <link rel="stylesheet" href="{{ url('admin/assets/stylesheetsdataTables.bootstrap4.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet"/>

  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ url('admin/assets/stylesheets/theme.css') }}" />

  <!-- Skin CSS -->
  <link rel="stylesheet" href="{{ url('admin/assets/stylesheets/skins/default.css') }}" />
    
  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href="{{ url('admin/assets/stylesheets/theme-custom.css') }}">
  

  <!-- Head Libs -->
  <script src="{{ url('admin/assets/vendor/modernizr/modernizr.js') }}"></script>
  <link rel="stylesheet" href="{{ url('admin/assets/stylesheets/styles.css') }}">
</head>
<body>
    <section class="body">
        <header class="header">
                <div class="logo-container">
                    <a href="{{ route('admin.dashboard') }}" class="logo">
                        <img src="{{ url('assets/images/admin_logo.png') }}" height="40" alt="expodisco" />
                    </a>
                    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                    </div>
                </div>
            
                <!-- start: search & user box -->
                <div class="header-right">

                    <span class="separator"></span>
            
                    <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <figure class="profile-picture">
                                <img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
                            </figure>
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                                <span class="name">{{ Auth::user()->name }}</span>
                                <span class="role">administrator</span>
                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>
                                </li>
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> {{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end: search & user box -->
            </header>

            <div class="inner-wrapper">
                <!-- start: sidebar -->
                <aside id="sidebar-left" class="sidebar-left">
                
                    <div class="sidebar-header">
                        <div class="sidebar-title">
                            Navigation
                        </div>
                        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                        </div>
                    </div>
                
                    <div class="nano">
                        <div class="nano-content">
                            <nav id="menu" class="nav-main" role="navigation">
                                <ul class="nav nav-main">
                                    <li class="nav-active">
                                        <a href="{{ route('admin.dashboard') }}">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span>Dashboard</span>
                                        </a>
                                    </li>
                                    

                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-copy" aria-hidden="true"></i>
                                            <span>Events</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="{{ route('admin.events') }}">
                                                     Event
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.event_types') }}">
                                                     Event Type
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.event_verticals') }}">
                                                     Event Verticals
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.add_verticals') }}">
                                                     Add new verticals
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-copy" aria-hidden="true"></i>
                                            <span>Vendors</span>
                                        </a>
                                        <ul class="nav nav-children">
                                           
                                            <li>
                                                <a href="{{ route('admin.vendor_categories') }}">
                                                     Categories
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.add_vendor_category') }}">
                                                     Add Category
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>

                                    <li class="nav-parent">
                                        <a>
                                            <i class="fa fa-copy" aria-hidden="true"></i>
                                            <span>Cities</span>
                                        </a>
                                        <ul class="nav nav-children">
                                            <li>
                                                <a href="{{ route('admin.cities') }}">
                                                     Cities
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin.add_city') }}">
                                                     Add city
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </li>
                                    
                                   

                                </ul>
                            </nav>
                
                
                           
                        </div>
                
                    </div>
                
                </aside>

            </div>


            @yield('content')
    </section>

        <!-- Vendor -->
        <script src="{{ url('admin/assets/vendor/jquery/jquery.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/nanoscroller/nanoscroller.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/magnific-popup/magnific-popup.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
        
        <!-- Specific Page Vendor -->
        <script src="{{ url('admin/assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-appear/jquery.appear.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-easypiechart/jquery.easypiechart.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/flot/jquery.flot.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/flot/jquery.flot.categories.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/raphael/raphael.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/morris/morris.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/gauge/gauge.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/snap-svg/snap.svg.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/jquery.vmap.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

        <!-- personally added -->
        <script src="{{ url('admin/assets/javascripts/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('admin/assets/javascripts/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js') }}"></script>
        <script src="{{ url('admin/assets/vendor/jquery-validation/jquery.validate.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
        
        <!-- Theme Base, Components and Settings -->
        <script src="{{ url('admin/assets/javascripts/theme.js') }}"></script>
        
        
        
        <!-- Theme Initialization Files -->
        <script src="{{ url('admin/assets/javascripts/theme.init.js') }}"></script>


        <!-- Examples -->
        <script src="{{ url('admin/assets/javascripts/dashboard/examples.dashboard.js') }}"></script>
        <script>
            var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
        </script>
        <script>
            {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
        </script>
        <script>
            $('#lfm').filemanager('file', {prefix: route_prefix});
            /* $('#gallaryimage1').filemanager('file', {prefix: route_prefix});
            $('#gallaryimage2').filemanager('file', {prefix: route_prefix});
            $('#gallaryimage3').filemanager('file', {prefix: route_prefix});
            $('#gallaryimage4').filemanager('file', {prefix: route_prefix}); */
            $('[id^=gallaryimage]').filemanager('file', {prefix: route_prefix});
            
            //$('.vendor_gallery_image').filemanager('file', {prefix: route_prefix});
        </script>
        <!-- Theme Custom -->
        <script src="{{ url('admin/assets/javascripts/theme.custom.js') }}"></script>

        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            var editor_config = {
            path_absolute : "",
            selector: "textarea[name=tm]",
            plugins: [
                "link image"
            ],
            relative_urls: false,
            height: 100,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
                if (type == 'image') {
                cmsURL = cmsURL + "&type=Files";
                } else {
                cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
                });
            }
            };

            tinymce.init(editor_config);
        </script>
    </body>
</html>