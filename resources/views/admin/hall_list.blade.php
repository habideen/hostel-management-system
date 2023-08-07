@extends('layouts.panel')

@section('title') Hall List @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Hall List</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Hall List</p>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Manage Hall</h4>

          @include('components.alert')
          
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Hall</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($halls->data as $hall)
                  <tr>
                    <td>{{$hall->id}}</td>
                    <td>{{$hall->name}}</td>
                    <td>{{date('d M, Y h:i a', strtotime($hall->created_at))}}</td>
                    <td>{{date('d M, Y h:i a', strtotime($hall->updated_at))}}</td>
                    <td><a href="/admin/update_hall?id={{$hall->id}}&name={{$hall->name}}" 
                      class="btn btn-primary">Update</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection



@section('script')

@endsection