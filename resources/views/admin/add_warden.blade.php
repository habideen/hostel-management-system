@extends('layouts.admin')

@php $title = $user ? 'Update Warden' : 'Add New Warden'; @endphp
@section('title') {{ $title }} @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">{{ $title }}</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">{{ $title }}</p>
      </div>
    </div>
  </div>

  <div class="col-md-8 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-4">
          <h4 class="card-title" id="card_title">{{ $title }}</h4>
          <div class="ms-auto">
            <a href="/admin/manage_warden/warden" class="btn btn-dark btn-sm">Warden List</a>
          </div>
        </div>
        
        @include('components.alert')
        
        <form class="forms-sample" action="/admin/update_warden" method="POST">
          @csrf
          <input type="hidden" name="id" id="id" value="{{old('id') ?? $user->id ?? ''}}">
          <div class="form-group row">
            <label for="hall_id" class="col-sm-3 col-form-label">Hall</label>
            <div class="col-sm-9">
                <select name="hall_id" id="hall_id" class="form-select" required>
                  <option value=""></option>
                  @foreach ($halls as $hall)
                    <option value="{{$hall->id}}">{{$hall->name}}</option>
                  @endforeach
                </select>
                @error('hall_id')
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
                  placeholder="e.g. Folarin" value="{{old('last_name') ?? $user->last_name ?? ''}}" 
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
                  placeholder="e.g. Bolarinwa" value="{{old('first_name') ?? $user->first_name ?? ''}}" 
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
                  placeholder="e.g. Wood" value="{{old('middle_name') ?? $user->middle_name ?? ''}}" 
                  pattern="^[a-zA-Z\-]{2,30}$">
                @error('middle_name')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="gender" class="col-sm-3 col-form-label">Gender *</label>
            <div class="col-sm-9">
                <select name="gender" id="gender" class="form-select" required>
                  <option value=""></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                @error('gender')
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
                  placeholder="e.g. Wood" value="{{old('phone_1') ?? $user->phone_1 ?? ''}}"
                  pattern="^[0][7-9][0-9]{9,9}$" required>
                @error('phone_1')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email *</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" 
                  placeholder="e.g. Wood" value="{{old('email') ?? $user->email ?? ''}}" required>
                @error('email')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">{{$user ? 'Save Changes' : 'Submit'}}</button>

          <button type="reset" class="btn btn-light {{$user ? 'd-none' : ''}}">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection



@section('script')
<script>
  $('#hall_id').val('{{old('hall_id') ?? $user->hall_id ?? ''}}')
  $('#gender').val('{{old('gender') ?? $user->gender ?? ''}}')
</script>
@endsection