@extends('layouts.panel')

@section('title') Block List @endsection


@section('content')
<!-- partial -->    
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="d-flex justify-content-between flex-wrap">
      <div class="d-flex align-items-end flex-wrap">
        <div class="me-md-3 me-xl-5">
          <h3 class="mb-0">Block List</h3>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
          <i class="mdi mdi-home text-muted hover-cursor"></i>
          <p class="text-muted mb-0 hover-cursor mute-crumb"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
          <p class="text-primary mb-0 hover-cursor">Block List</p>
      </div>
    </div>
  </div>

  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Manage Blocks</h4>

          @include('components.alert')
          
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Hall</th>
                  <th>Block</th>
                  <th>Room Starts At</th>
                  <th>No. of Rooms</th>
                  <th>Room Capacity</th>
                  <th>Gender</th>
                  <th>Created At</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($blocks->data as $block)
                  <tr>
                    <td>{{$block->id}}</td>
                    <td>{{$block->hall}}</td>
                    <td>{{$block->name}}</td>
                    <td>{{$block->first_room_number}}</td>
                    <td>{{$block->no_of_rooms}}</td>
                    <td>{{$block->room_capacity}}</td>
                    <td>{{$block->gender}}</td>
                    <td>{{date('d M, Y h:i a', strtotime($block->created_at))}}</td>
                    <td><a href="/admin/update_block?id={{$block->id}}&name={{$block->name}}" 
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