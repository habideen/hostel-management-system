@extends('layouts.panel')

@section('title')
    View Bedspace
@endsection


@section('content')
    <!-- partial -->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h3 class="mb-0">View Bedspace</h3>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor mute-crumb"><a
                            href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
                    <p class="text-primary mb-0 hover-cursor">View Bedspace</p>
                </div>
            </div>
        </div>

        @include('components.alert')

        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body pt-5">
                    <div class="d-flex">
                        <h4 class="card-title mb-4">Rooms</h4>
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
                                        <th><a href="/student/bed_space_info?roomID={{$room->id}}'&ref={{urlencode(url()->full())}}">View</a></th>
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
