@extends('layouts.panel')

@section('title')
    Manage Bedspace
@endsection


@section('content')
    <!-- partial -->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h3 class="mb-0">Manage Bedspace</h3>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor mute-crumb"><a
                            href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
                    <p class="text-primary mb-0 hover-cursor">Manage Bedspace</p>
                </div>
            </div>
        </div>

        @include('components.alert')

        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body pt-5">
                    <h4 class="mb-4"><b>Current Session: </b>{{ currentSession() }}</h4>
                    <a href="/admin/generate_rooms" class="btn btn-primary me-2">Generate available rooms for this
                        session</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin">
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
        </div>

        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body pt-5">
                    <div class="d-flex">
                        <h4 class="card-title mb-4">Rooms</h4>
                    </div>
                    <p class="mb-2"><b>Session: </b>{{ $session ?? currentSession() ?? 'No session set yet' }}</p>
                    <p class="mb-2"><b>Number occupied: </b>{{ $occupied }}</p>
                    <p class="mb-4"><b>Number Vacant: </b>{{ $vacant }}</p>
                    <div class="table-responsiveeee">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Hall</th>
                                    <th>Block</th>
                                    <th>Room</th>
                                    <th>Bed</th>
                                    <th>Occupied</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <th>{{ $room->hall }}</th>
                                        <th>{{ $room->block }}</th>
                                        <th>{{ $room->room_no }}</th>
                                        <th>{{ $room->bed_space }}</th>
                                        <th>{!! $room->user_id ? "<a href='/admin/bed_space_info'>View</a>" : '' !!}</th>
                                        <th></th>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            const dataTable = $('#dataTable').DataTable();
        });
    </script>
@endsection
