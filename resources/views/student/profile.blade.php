@extends('layouts.panel')

@section('title') Update Profile @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Update Profile</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Update Profile</p>
      </div>
    </div>
  </div>

  <div class="col-md-8 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-4">
          <h4 class="card-title" id="card_title">Update Profile</h4>
          <div class="ms-auto">
            <a href="/admin/manage_warden/warden" class="btn btn-dark btn-sm">Warden List</a>
          </div>
        </div>
        
        @include('components.alert')
        
        <form class="forms-sample" action="/profile" method="POST">
          @csrf
          <div class="form-group row">
            <label for="matric_no" class="col-sm-3 col-form-label">Matric Number *</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="matric_no" id="matric_no" 
                  placeholder="e.g. CSC/2017/193" value="{{ old('matric_no') ?? Auth::user()->matric_no ?? '' }}" 
                  pattern="^[A-Z]{3}\/\d{4}\/\d{3}$" required>
                @error('matric_no')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="last_name" class="col-sm-3 col-form-label">Last Name *</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="last_name" id="last_name" 
                  placeholder="e.g. Folarin" value="{{old('last_name') ?? Auth::user()->last_name ?? ''}}" 
                  pattern="^[a-zA-Z\-]{2,30}$" required>
                @error('last_name')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="first_name" class="col-sm-3 col-form-label">First Name *</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="first_name" id="first_name" 
                  placeholder="e.g. Bolarinwa" value="{{old('first_name') ?? Auth::user()->first_name ?? ''}}" 
                  pattern="^[a-zA-Z\-]{2,30}$" required>
                @error('first_name')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="middle_name" class="col-sm-3 col-form-label">Middle Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="middle_name" id="middle_name" 
                  placeholder="e.g. Wood" value="{{old('middle_name') ?? Auth::user()->middle_name ?? ''}}" 
                  pattern="^[a-zA-Z\-]{2,30}$">
                @error('middle_name')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="phone_1" class="col-sm-3 col-form-label">Phone number *</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="phone_1" id="phone_1" 
                  placeholder="e.g. Wood" value="{{old('phone_1') ?? Auth::user()->phone_1 ?? ''}}"
                  pattern="^[0][7-9][0-9]{9,9}$" required>
                @error('phone_1')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          {{-- <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email *</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" 
                  placeholder="e.g. Wood" value="{{old('email') ?? Auth::user()->email ?? ''}}" required>
                @error('email')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div> --}}
          <button type="submit" class="btn btn-primary me-2">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection



@section('script')
<script>
</script>
@endsection