<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Masterstroke Admin</title>
    <link rel="stylesheet" href="{{ asset('securepanel/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('securepanel/css/custom-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('securepanel/css/owl.carousel.css') }}">    
    @yield('style')
</head>
<body>
    <div class="loader"></div>
    <div id="app">
    <div class="wrapper">
            <!-- Main header start here -->
            @include('admin.layouts.header')
            <!-- main header end -->
            <!-- Main sidebar start here -->
            @include('admin.layouts.sidebar')
            <!-- Main sidebar end -->
            <!-- Main content/Body -->
            @yield('content')
            <!-- end main body -->           
        </div>
    </div>
    <script src="{{ asset('securepanel/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('securepanel/js/custom.js') }}"></script>
    <script src="{{ asset('securepanel/js/owl.carousel.js') }}"></script>
  
</body>

</html>
    