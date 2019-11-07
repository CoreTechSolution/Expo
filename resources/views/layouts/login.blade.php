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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">

    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>
<body>

@yield('content')



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js" integrity="sha256-bmXHkMKAxMZgr2EehOetiN/paT9LXp0KKAKnLpYlHwE=" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script> 

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
