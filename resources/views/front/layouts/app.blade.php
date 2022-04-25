<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(!empty($metas))
        @if($metas['meta_description'])
            <meta name="description" content="{{$metas['meta_description']}}">
        @endif
        @if($metas['meta_keyword'])
            <meta name="keywords" content="{{$metas['meta_keyword']}}">
        @endif
        @if($metas['home_title'] && $metas['site_title'])
            <title>{{ $metas['home_title'] }} | {{ $metas['site_title'] }}</title>
            @else
                <title>@yield('title')</title>
        @endif
    @else
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
    @endif

    <link rel="icon" href="{{ getFaviconUrl() }}" type="image/png">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href=" {{ asset('front/css/bootstrap.min.css') }} " type="text/css"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/slider/css/slick-theme.min.css') }} " type="text/css"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/slider/css/slick.css') }} " type="text/css"/>
    <!-- slider -->
    <link rel="stylesheet" href=" {{ asset('front/css/swiper-bundle.min.css') }} "/>

    <!-- Icon -->
    <link rel="stylesheet" href=" {{ asset('front/css/materialdesignicons.min.css') }} " type="text/css"/>

    <!-- css -->
    <link rel="stylesheet" href=" {{ asset('front/css/style.min.css') }} " type="text/css"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/custom.css') }} "/>

    <!-- General CSS Files -->
    <link href="{{ asset('backend/css/datatables.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/fonts.css') }}" rel="stylesheet" type="text/css"/>

    @yield('page_css')
    <link href="{{ asset('backend/css/3rd-party.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend/css/3rd-party-custom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ mix('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
    @yield('css')
</head>
<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="71">

@include('front.layouts.header')
@yield('content')
@include('front.layouts.footer')

<!--start back-to-top-->
<button onclick="topFunction()" id="back-to-top">
    <i class="mdi mdi-arrow-up"></i>
</button>
<!--end back-to-top-->
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
<script src="{{ asset('backend/js/vendor.js') }}"></script>
<script src="{{ asset('backend/js/datatables.js') }}"></script>
<script src="{{ asset('backend/js/3rd-party-custom.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>

<!--Custom js-->
<script src=" {{ asset('front/js/counter.js') }}"></script>

<script src=" {{ asset('front/js/swiper-bundle.min.js') }}"></script>

<!--Bootstrap Js-->
{{--<script src=" {{ asset('front/js/bootstrap.bundle.min.js') }} "></script>--}}
<script src=" {{ asset('assets/js/slider/js/slick.min.js') }} "></script>
<!-- contact -->
{{--<script src=" {{ asset('front/js/contact.js') }} "></script>--}}

<!-- App Js -->
<script src=" {{ asset('front/js/app.js') }} "></script>

<script src="{{mix('assets/js/home_page/home_page.js')}}"></script>


@routes
@yield('page_js')
@yield('scripts')
</body>
</html>
