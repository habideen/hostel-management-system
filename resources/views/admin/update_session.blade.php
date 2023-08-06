@extends('layouts.admin')

@section('title') Update Session @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Update Session</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Update Session</p>
      </div>
    </div>
  </div>

  <div class="col-md-5 grid-margin">
    <div class="card">
      <div class="card-body pt-5">

        @include('components.alert')
        
        <form class="forms-sample" action="/admin/update_session" method="POST">
          @csrf
          <div class="form-group row">
            <label for="session" class="col-sm-3 col-form-label">Session</label>
            <div class="col-sm-9">
                <select name="session" id="session" class="form-select" required>
                  <option value=""></option>
                  @php
                  $date2=date('Y', strtotime('+1 Years'));
                  @endphp
                  @for ($i=date('Y', strtotime('-3 Years')); $i<$date2;$i++) <!-- -->
                    @php //
                    $x=$i.'/'.($i+1); //
                    @endphp //
                    <option value="{{$x}}">{{$x}}</option>
                  @endfor
                </select>
                @error('session')
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

  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body pt-5">
        <h4 class="card-title mb-4">Previous Sessions</h4>

        <p class="mb-4"><b>Current Session: </b>{{currentSession() ?? 'No session set yet'}}</p>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Session</th>
                <th>Created At</th>
                <th>Updated At</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($sessions as $session)
                <tr>
                  <td>{{$session->id}}</td>
                  <td>{{$session->session}}</td>
                  <td>{{date('d M, Y h:i a', strtotime($session->created_at))}}</td>
                  <td>{{date('d M, Y h:i a', strtotime($session->updated_at))}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection



@section('script')

@endsection