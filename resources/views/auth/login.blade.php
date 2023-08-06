@extends('layouts.auth')

@section('title') Login @endsection
@section('bodyTagProp') class="bg-light" @endsection


@section('content')
<div class="container-scroller">
  <div class="row w-100 mx-0 mt-5">
    <div class="col-sm-7 col-md-5 col-lg-4 mx-auto mt-5">
      <div class="auth-form-light text-left py-5 px-4 px-sm-5 bg-white shadow-sm rounded">
        <div class="mb-3">
          <h4>User Login</h4>
        </div>

        @include('components.alert')
        
        <form action="/login" method="POST" class="pt-3">
          @csrf
          <div class="form-group">
            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
              name="email" id="email" placeholder="Enter email" autocomplete="email" autofocus>
          </div>
          <div class="form-group">
            <input type="password" class="form-control form-control-lg" 
              name="password" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
          </div>

          <div class="mt-5">
            <a href="forgot_password.php" style="text-decoration:none;">Reset my password</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- page-body-wrapper ends -->
</div>
@endsection