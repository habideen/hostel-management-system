@extends('layouts.admin')

@section('title') Manage Hall @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Manage Hall</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Manage Hall</p>
      </div>
    </div>
  </div>

  <div class="col-md-8 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title" id="card_title">Add New Hall</h4>
        
        @include('components.alert')
        
        <form class="forms-sample" action="/admin/update_hall" method="POST">
          @csrf
          <input type="text" name="id" id="id">
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Hall name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" 
                  placeholder="Enter hall name" value="{{old('name')}}" required>
                @error('name')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Submit</button>
          <button type="reset" class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection



@section('script')

@endsection