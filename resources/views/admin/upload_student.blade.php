@extends('layouts.admin')

@section('title') Upload Students @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Upload Students</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Upload Students</p>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body pt-5">

        @include('components.alert')
        
        <form class="forms-sample" action="/admin/upload_student" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
            <label for="file" class="col-md-4 col-lg-2 col-form-label">Students Excel File</label>
            <div class="col-md-8 col-lg-10">
              <input class="form-control" type="file" name="file" id="file" accept=".xls, .xlsx" required>
              <span class="text-muted fs-6">File types: xlsx, xls</span>
                @error('file')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Update</button>

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