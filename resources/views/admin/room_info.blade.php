@extends('layouts.panel')

@section('title')
    Room Information
@endsection


@section('content')
    <!-- partial -->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h3 class="mb-0">Room Information</h3>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor mute-crumb"><a
                            href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
                    <p class="text-primary mb-0 hover-cursor">Room Info</p>
                </div>
            </div>
        </div>

        @include('components.alert')

        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body pt-5">
                    {{-- {{dd($room)}} --}}
                    <h5 class="mb-3"><b>Room ID: </b>{{$room->id}}</h5>
                    <h5 class="mb-3"><b>Name: </b>{{strtoupper($room->last_name)}} {{$room->first_name}} {{$room->middle_name}}</h5>
                    <h5 class="mb-3"><b>Matric Number: </b>{{$room->matric_no}}</h5>
                    <h5 class="mb-3"><b>Gender: </b>{{$room->gender}}</h5>
                    <h5 class="mb-3"><b>Hall: </b>{{$room->hall}}</h5>
                    <h5 class="mb-3"><b>Block: </b>{{$room->block}}</h5>
                    <h5 class="mb-3"><b>Room Number: </b>{{$room->room_no}}</h5>
                    <h5 class="mb-3"><b>Bed Space: </b>{{$room->bed_space}}</h5>
                    <h5 class="mb-4"><b>Session: </b>{{$room->session}}</h5>

                    <h5><a href="{{Request::get('ref')}}">Go back</a></h5>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body pt-5">
                    <form class="forms-sample" action="/admin/rooms" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label for="session" class="col-sm-3 col-form-label">Session</label>
                            <div class="col-sm-9">
                                <select name="session" id="session" class="form-select" required>
                                    <option value=""></option>
                                    @foreach (allSessions() as $x)
                                      <option value="{{$x->id}}">{{$x->session}}</option>
                                    @endforeach
                                </select>
                                @error('session')
                                    <span class="text-danger" role="alert">
                                        <span>{{ $message }}</span>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Filter Rooms by Session</button>

                        <button type="reset" class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- main-panel ends -->
@endsection



@section('script')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            const dataTable = $('#dataTable').DataTable();
        });
    </script>
@endsection
