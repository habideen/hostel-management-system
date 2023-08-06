<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title') - {{env('APP_NAME')}}</title>
  <!-- Required meta tags -->
  @include('components.style')
  @yield('css')
  @yield('upScript')
</head>

<body @yield('bodyTagProp')>
  @yield('content')

  @include('components.script')
  @yield('script')
</body>

</html>