<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title') - {{env('APP_NAME')}}</title>
  <!-- Required meta tags -->
  @include('components.style')
  <link rel="stylesheet" href="/assets/css/custom.css">
  @yield('css')
  @yield('upScript')
</head>

<body>
  <div class="container-scroller">
    @include('components.panel_topnav')
  
    <div class="container-fluid page-body-wrapper">
      @if (Request::segment(1) == 'admin')
      @include('components.admin_sidebar')
      @elseif (Request::segment(1) == 'student')
      @include('components.student_sidebar')
      @elseif (Request::segment(1) == 'warden')
      @include('components.warden_sidebar')
      @endif

      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('components.panel_footer')
        <!-- partial -->
      </div>
    </div>
  </div>

  <script src="/assets/vendors/base/vendor.bundle.base.js"></script>
  <script src="/assets/js/template.js"></script>
  @include('components.script')
  @yield('script')
</body>

</html>