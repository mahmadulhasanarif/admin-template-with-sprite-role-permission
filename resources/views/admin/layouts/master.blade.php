<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Admin Dashboard</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap4.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('backend/css/app-light.css')}}" id="lightTheme" disabled>
    <link rel="stylesheet" href="{{asset('backend/css/app-dark.css')}}" id="darkTheme">
    @yield('styles')
  </head>
  <body class="vertical  dark  ">
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            @include('admin.layouts.header')    <!--Header Layouts-->
        </nav>

        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
              <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light">
                @include('admin.layouts.sidebar') <!--Sidebar Layouts-->
            </nav>
        </aside>

        <main role="main" class="main-content">
            @yield('main')
        </main> <!-- main -->

        <!--notification Layouts-->
        @include('admin.layouts.notification')

    </div> <!-- .wrapper -->
    @include('admin.layouts.script')
    @yield('scripts')
    @include('sweetalert::alert')
   </body>
 </html>