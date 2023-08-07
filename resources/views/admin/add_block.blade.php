@extends('layouts.panel')

@php $title = $block ? 'Update Block' : 'Add New Block'; @endphp
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
            <a href="/admin/manage_block" class="btn btn-dark btn-sm">Block List</a>
          </div>
        </div>
        
        @include('components.alert')
        
        <form class="forms-sample" action="/admin/update_block" method="POST">
          @csrf
          <input type="hidden" name="id" id="id" value="{{old('id') ?? $block->id ?? ''}}">
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
            <label for="name" class="col-sm-3 col-form-label">Block name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="name" id="name" 
                  placeholder="e.g. Anex" value="{{old('name') ?? $block->name ?? ''}}" required>
                @error('name')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="first_room_number" class="col-sm-3 col-form-label">First Room Number</label>
            <div class="col-sm-9">
                <input type="number" min="1" step="1" class="form-control" name="first_room_number" id="first_room_number" 
                  placeholder="e.g. 210" value="{{old('first_room_number') ?? $block->first_room_number ?? ''}}" required>
                @error('first_room_number')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="no_of_rooms" class="col-sm-3 col-form-label">Number of rooms</label>
            <div class="col-sm-9">
                <input type="number" min="1" step="1" class="form-control" name="no_of_rooms" id="no_of_rooms" 
                  placeholder="e.g. 20" value="{{old('no_of_rooms') ?? $block->no_of_rooms ?? ''}}" required>
                @error('no_of_rooms')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="room_capacity" class="col-sm-3 col-form-label">Room capacity</label>
            <div class="col-sm-9">
                <input type="number" min="1" step="1" class="form-control" name="room_capacity" id="room_capacity" 
                  placeholder="e.g. 6" value="{{old('room_capacity') ?? $block->room_capacity ?? ''}}" required>
                @error('room_capacity')
                <span class="text-danger" role="alert">
                    <span>{{ $message }}</span>
                </span>
                @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">{{$block ? 'Save Changes' : 'Submit'}}</button>

          <button type="reset" class="btn btn-light {{$block ? 'd-none' : ''}}">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- main-panel ends -->
@endsection



@section('script')
<script>
  $('#hall_id').val('{{old('hall_id') ?? $block->hall_id ?? ''}}')
</script>
@endsection