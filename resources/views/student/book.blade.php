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
            <a href="/student/my_hostels" class="btn btn-dark btn-sm">View My Hostels</a>
          </div>
        </div>
        
        @include('components.alert')
        
        <h4 class="mb-4"><b>Current Session: </b>{{currentSession()}}</h4>
        
        <a href="/student/book" class="btn btn-primary me-2">Book for bedspace</a>
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