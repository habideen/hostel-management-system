<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title') - {{env('APP_NAME')}}</title>
  <!-- Required meta tags -->
  @include('components.style')
  @yield('css')
  @yield('upScript')
</head>

<body>
  <div class="container-scroller">
    @include('components.panel_topnav')
  
    <div class="container-fluid page-body-wrapper">
      @include('components.admin_sidebar')

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