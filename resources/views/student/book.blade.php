@extends('layouts.panel')

@section('title') Book Now @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Book Now</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Book Now</p>
      </div>
    </div>
  </div>

  <div class="col-md-8 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex mb-4">
          <h4 class="card-title" id="card_title">Book Now</h4>
          <div class="ms-auto">
            <a href="/admin/manage_warden/warden" class="btn btn-dark btn-sm">Warden List</a>
          </div>
        </div>
        
        @include('components.alert')
        
        <form class="forms-sample" action="/admin/update_warden" method="POST">
          @csrf
          <div class="form-group row">
            <label for="matric_no" class="col-sm-3 col-form-label">Matric Number *</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="matric_no" id="matric_no" 
                  placeholder="e.g. Folarin" value="{{old('matric_no')}}" 
                  pattern="^[a-zA-Z\-]{2,30}$" required>
                @error('matric_no')
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