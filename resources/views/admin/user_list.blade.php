@extends('layouts.admin')

@section('title') {{$account_type}} List @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">{{$account_type}} List</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">{{$account_type}} List</p>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Manage {{$account_type}}</h4>

          @include('components.alert')
          
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Created At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users->data as $user)
                  <tr>
                    <td>{{strtoupper($user->last_name)}} {{$user->first_name}}  {{$user->middle_name}}</td>
                    <td>{{$user->gender}}</td>
                    <td>{{$user->phone_1}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{date('d M, Y h:i a', strtotime($user->created_at))}}</td>
                    <td><a href="/admin/update_warden?id={{$user->id}}&account_type={{$account_type}}&name={{strtoupper($user->last_name)}} {{$user->first_name}}  {{$user->middle_name}}" 
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