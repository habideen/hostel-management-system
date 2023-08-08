@extends('layouts.panel')

@section('title')
    Dashboard
@endsection


@section('content')
    <!-- partial -->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome back,</h2>
                        <p class="mb-md-0">Your analytics dashboard template.</p>
                    </div>
                    <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                        <p class="text-primary mb-0 hover-cursor">Analytics</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap d-none">
                    <button type="button" class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                        <i class="mdi mdi-download text-muted"></i>
                    </button>
                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <i class="mdi mdi-clock-outline text-muted"></i>
                    </button>
                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                        <i class="mdi mdi-plus text-muted"></i>
                    </button>
                    <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
                </div>
            </div>
        </div>



        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body pt-5">
                    <h4 class="mb-3"><b>Current Session: </b>{{ currentSession() }}</h4>
                    <div class="d-flex">
                        <h4 class="card-title mb-4">My Rooms</h4>
                    </div>
                    <div class="table-responsiveeee">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Hall</th>
                                    <th>Block</th>
                                    <th>Room</th>
                                    <th>Bed</th>
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
                                        <th><a
                                                href="/student/bed_space_info?roomID={{ $room->id }}'&ref={{ urlencode(url()->full()) }}">View</a>
                                        </th>
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
