@extends('layouts.template')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}">
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
@endsection
@section('info-page')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
            {{ str_replace('-', ' ', Request::path()) }}</li>
    </ol>
    <h5 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h5>
@endsection
@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- DataTable with Buttons -->
            <div class="card" id="card-block">
                <div class="card-datatable  pt-0">
                    <table class="table table-wrapper table-responsive" id="table-data">
                        <thead>
                            <tr>
                                <th class="align-middle">No</th>
                                <th class="align-middle">Name</th>
                                <th class="align-middle">Email</th>
                                <th class="align-middle">Phone Number</th>
                                <th class="align-middle">Country</th>
                                <th class="align-middle"></th>
                            </tr>
                        </thead>
                    </table>

                    <!-- Modal Delete-->
                    <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalCenterTitle">Delete Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <p>Are you sure want to delete this data?</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form id="delete-form">
                                        <input id="delete-id" class="d-none" />
                                        <button type="button" class="btn btn-label-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button"
                                            data-bs-dismiss="modal">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('vendor-javascript')
    <script src="{{ asset('./assets/dashboard/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/datatables-buttons.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-buttons/buttons.html5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-fixedheader-bs5/fixedheader.bootstrap5.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-fixedcolumns/datatables.fixedcolumns.js') }}"></script>
    <!-- Row Group JS -->
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup/datatables.rowgroup.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.js') }}"></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#table-data').DataTable({
                "destroy": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ env('URL_API') }}/api/v1/user",
                    "type": "GET",
                    'beforeSend': function(request) {
                        request.setRequestHeader("Authorization",
                            "Bearer {{ $token }}");
                    },
                    "data": {},
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'phone_number',

                    },
                    {
                        data: 'country',

                    },
                    {
                        data: null,
                        title: "Actions",
                        render: function(data, type, row) {
                            return '<div >' + 
                                        '<a href="/nantikirimemailxendit" role="button" class="btn  btn-primary text-decoration-none">Kirim Email Reward</a>' + 
                                        '<a href="/nantikirimemailrevisi" role="button" class="btn mx-2 btn-danger text-decoration-none">Kirim Email Revisi</a>' +
                                    '</div>';
                        },
                        "orderable": false,
                        "searchable": false

                    },
                ],
                "language": {
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "lengthMenu": "Show _MENU_ entries",
                    "loadingRecords": "Loading...",
                    "processing": "Processing...",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "<i class='fa-solid fa-angle-double-left'></i>",
                        "last": "<i class='fa-solid fa-angle-double-right'></i>",
                        "next": "<i class='fa-solid fa-angle-right'></i>",
                        "previous": "<i class='fa-solid fa-angle-left'></i>"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [7, 10, 25, 50],
                buttons: [{
                    text: '<i class="fas fa-user-plus me-sm-1 text-center"></i> <span class="d-none d-sm-inline-block">Add User</span>',
                    className: "create-new btn btn-primary",
                    action: function(e, dt, node, config) {
                        window.location = 'user/create';
                    }
                }, {
                    text: '<i class="fas fa-file-csv me-sm-1 text-center"></i> <span class="d-none d-sm-inline-block">Add CSV</span>',
                    className: "create-new btn btn-success",
                    action: function(e, dt, node, config) {
                        window.location = 'user/create-csv';
                    }
                }],
                scrollX: true, // Add this line to enable horizontal scrolling
                width: "100%"
            }), $("div.head-label").html('<h5 class="card-title mb-0">User Data</h5>');

        });
    </script>
@endsection
