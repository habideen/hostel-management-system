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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3"><b>Current Session: </b>{{currentSession()}}</h4>
                        <h4 class="card-title">All Hostel Blocks</h4>

                        @include('components.alert')

                        <table class="table" id="dataTable">
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
                                        <td>{{ $block->id }}</td>
                                        <td>{{ $block->hall }}</td>
                                        <td>{{ $block->name }}</td>
                                        <td>{{ $block->first_room_number }}</td>
                                        <td>{{ $block->no_of_rooms }}</td>
                                        <td>{{ $block->room_capacity }}</td>
                                        <td>{{ $block->gender }}</td>
                                        <td>{{ date('d M, Y h:i a', strtotime($block->created_at)) }}</td>
                                        <td><a href="/admin/update_block?id={{ $block->id }}&name={{ $block->name }}"
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
