@extends('layouts.template')
@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
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
                <div class="card-datatable table-responsive pt-0">
                    <table class="table" id="table-data">
                        <thead>
                            <th></th>
                        </thead>
                    </table>
                    <!-- Modal Add Form -->
                    <div class="modal fade" id="modalAdd" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Topic</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="add-form">
                                        <div class="mb-3">
                                            <label for="add-name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="add-name" name="add-name"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-description" class="form-label">Description</label>
                                            <textarea class="form-control" id="add-description" name="add-description" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-category" class="form-label">Category</label>
                                            <div>
                                                <input type="checkbox" id="hic" name="add-category[]"
                                                    value="High income">
                                                <label for="hic">High income</label><br>
                                                <input type="checkbox" id="lic" name="add-category[]"
                                                    value="Low income">
                                                <label for="lic">Low income</label><br>
                                                <input type="checkbox" id="lmc" name="add-category[]"
                                                    value="Lower middle income">
                                                <label for="lmc">Lower middle income</label><br>
                                                <input type="checkbox" id="lmy" name="add-category[]"
                                                    value="Low & middle income">
                                                <label for="lmy">Low & middle income</label><br>
                                                <input type="checkbox" id="mic" name="add-category[]"
                                                    value="Middle income">
                                                <label for="mic">Middle income</label><br>
                                                <input type="checkbox" id="umc" name="add-category[]"
                                                    value="Upper middle income">
                                                <label for="umc">Upper middle income</label><br>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-url-form" class="form-label">URL Form</label>
                                            <input type="text" class="form-control" id="add-url-form" name="add-url-form"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="add-url-spreadsheet" class="form-label">URL Spreadsheet</label>
                                            <input type="text" class="form-control" id="add-url-spreadsheet"
                                                name="add-url-spreadsheet" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <input id="delete-guid" class="d-none" />
                                        <button type="button" class="btn btn-label-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" type="button"
                                            data-bs-dismiss="modal">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Edit-->
                    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Topic</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-form">
                                        <div class="mb-3">
                                            <label for="guid" class="form-label">guid</label>
                                            <input type="text" class="form-control" id="guid" name="guid"
                                                required readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="update-name" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="update-name"
                                                name="update-name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="update-description" class="form-label">Description</label>
                                            <textarea class="form-control" id="update-description" name="update-description" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="update-category" class="form-label">Category</label>
                                            <div>
                                                <input type="checkbox" id="hic" name="update-category[]"
                                                    value="High income">
                                                <label for="hic">High income</label><br>
                                                <input type="checkbox" id="lic" name="update-category[]"
                                                    value="Low income">
                                                <label for="lic">Low income</label><br>
                                                <input type="checkbox" id="lmc" name="update-category[]"
                                                    value="Lower middle income">
                                                <label for="lmc">Lower middle income</label><br>
                                                <input type="checkbox" id="lmy" name="update-category[]"
                                                    value="Low & middle income">
                                                <label for="lmy">Low & middle income</label><br>
                                                <input type="checkbox" id="mic" name="update-category[]"
                                                    value="Middle income">
                                                <label for="mic">Middle income</label><br>
                                                <input type="checkbox" id="umc" name="update-category[]"
                                                    value="Upper middle income">
                                                <label for="umc">Upper middle income</label><br>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="update-url-form" class="form-label">url Form</label>
                                            <input type="text" class="form-control" id="update-url-form"
                                                name="update-url-form" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="update-url-spreadsheet" class="form-label">url
                                                Spreadsheet</label>
                                            <input type="text" class="form-control" id="update-url-spreadsheet"
                                                name="update-url-spreadsheet" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('./assets/dashboard/datatables-buttons/buttons.print.js') }}"></script>
    <!-- Row Group JS -->
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup/datatables.rowgroup.js') }}"></script>
    <script src="{{ asset('./assets/dashboard/datatables-rowgroup-bs5/rowgroup.bootstrap5.js') }}"></script>
@endsection
@section('custom-javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ env('URL_API') }}/api/v1/form/result/{{ $form }}",
                beforeSend: function(request) {
                    request.setRequestHeader("Authorization", "Bearer {{ $token }}");
                },
                success: function(result) {
                    if (result.data && result.data.length > 0) {
                        let headers = Object.keys(result.data[0]);
                        let headerHTML = '';
                        headers.forEach(function(header) {
                            headerHTML += '<th>' + header + '</th>';
                        });
                        $('thead').html('<tr>' + headerHTML + '</tr>');

                        let columns = headers.map(function(header) {
                            return {
                                data: header
                            };
                        });
                        console.log(columns);
                        $('#table-data').DataTable({
                            "destroy": true,
                            "processing": true,
                            "serverSide": true,
                            "data": result.data, // Ensure this is the correct data array
                            "columns": columns,
                            // "language": {
                            //     "emptyTable": "No data available in table",
                            //     "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                            //     "infoEmpty": "Showing 0 to 0 of 0 entries",
                            //     "lengthMenu": "Show _MENU_ entries",
                            //     "loadingRecords": "Loading...",
                            //     "processing": "Processing...",
                            //     "zeroRecords": "No matching records found",
                            //     "paginate": {
                            //         "first": "<i class='fa-solid fa-angle-double-left'></i>",
                            //         "last": "<i class='fa-solid fa-angle-double-right'></i>",
                            //         "next": "<i class='fa-solid fa-angle-right'></i>",
                            //         "previous": "<i class='fa-solid fa-angle-left'></i>"
                            //     },
                            //     "aria": {
                            //         "sortAscending": ": activate to sort column ascending",
                            //         "sortDescending": ": activate to sort column descending"
                            //     }
                            // },
                            // dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                            // displayLength: 10,
                            // lengthMenu: [7, 10, 25, 50],
                            buttons: [],
                            // responsive: {
                            //     details: {
                            //         display: $.fn.dataTable.Responsive.display.modal({
                            //             header: function(e) {
                            //                 return "Details of " + e.data().name;
                            //             }
                            //         }),
                            //         type: "column",
                            //         renderer: function(e, t, a) {
                            //             a = $.map(a, function(e, t) {
                            //                 return e.title ?
                            //                     `<tr data-dt-row="${e.rowIndex}" data-dt-column="${e.columnIndex}"><td>${e.title}:</td> <td>${e.data}</td></tr>` :
                            //                     "";
                            //             }).join("");
                            //             return a ? $('<table class="table"/><tbody />')
                            //                 .append(a) : false;
                            //         }
                            //     }
                            // },
                        });
                        $("div.head-label").html('<h5 class="card-title mb-0">Topic Data</h5>');
                    } else {
                        console.error('No data available');
                        alert('No data available in table');
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error occurred: ' + errorMessage);
                }
            });
            // $('#table-data').DataTable({
            //     "destroy": true,
            //     "processing": true,
            //     "serverSide": true,
            //     "ajax": {
            //         "url": "{{ env('URL_API') }}/api/v1/form/result/{{ $form }}",
            //         "type": "GET",
            //         'beforeSend': function(request) {
            //             request.setRequestHeader("Authorization",
            //                 "Bearer {{ $token }}");
            //         },
            //         "data": {},
            //     },
            //     "columns": [
            //         "data": null,
            //         "render": function(data) {
            //             // Generate dynamic columns based on data received
            //             let columnsHTML = '';
            //             for (let key in data) {
            //                 columnsHTML += '<td>' + data[key] + '</td>';
            //             }
            //             return columnsHTML;
            //         }
            //     ],
            //     "language": {
            //         "emptyTable": "No data available in table",
            //         "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            //         "infoEmpty": "Showing 0 to 0 of 0 entries",
            //         "lengthMenu": "Show _MENU_ entries",
            //         "loadingRecords": "Loading...",
            //         "processing": "Processing...",
            //         "zeroRecords": "No matching records found",
            //         "paginate": {
            //             "first": "<i class='fa-solid fa-angle-double-left'></i>",
            //             "last": "<i class='fa-solid fa-angle-double-right'></i>",
            //             "next": "<i class='fa-solid fa-angle-right'></i>",
            //             "previous": "<i class='fa-solid fa-angle-left'></i>"
            //         },
            //         "aria": {
            //             "sortAscending": ": activate to sort column ascending",
            //             "sortDescending": ": activate to sort column descending"
            //         }
            //     },
            //     dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            //     displayLength: 10,
            //     lengthMenu: [7, 10, 25, 50],
            //     buttons: [{
            //         text: '<i class="fa-solid fa-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add Topic</span>',
            //         className: "create-new btn btn-primary",
            //         action: function(e, dt, node, config) {
            //             $('#modalAdd').modal('show');
            //         }
            //     }],
            //     responsive: {
            //         details: {
            //             display: $.fn.dataTable.Responsive.display.modal({
            //                 header: function(e) {
            //                     return "Details of " + e.data().name
            //                 }
            //             }),
            //             type: "column",
            //             renderer: function(e, t, a) {
            //                 a = $.map(a, function(e, t) {
            //                     return "" !== e.title ? '<tr data-dt-row="' + e
            //                         .rowIndex +
            //                         '" data-dt-column="' + e.columnIndex + '"><td>' + e
            //                         .title +
            //                         ":</td> <td>" + e.data + "</td></tr>" : ""
            //                 }).join("");
            //                 return !!a && $('<table class="table"/><tbody />').append(a)
            //             }
            //         }
            //     },
            // }), $("div.head-label").html('<h5 class="card-title mb-0">Topic Data</h5>');

            // $(document).on("click", ".open-delete-dialog", function() {
            //     var guid = $(this).data('guid');
            //     $("#delete-guid").val(guid);
            // });

            // $('#delete-form').on('submit', function(e) {
            //     e.preventDefault();

            //     var guid = $('#delete-guid').val();

            //     $.ajax({
            //         type: "DELETE",
            //         url: "{{ env('URL_API') }}/api/v1/form/" + guid,
            //         data: {

            //         },
            //         beforeSend: function(request) {
            //             request.setRequestHeader("Authorization",
            //                 "Bearer {{ $token }}");

            //         },
            //         success: function(result) {
            //             window.location.href = "{{ route('form') }}";
            //         },
            //         error: function(xhr, status, error) {
            //             var errorMessage = xhr.status + ': ' + xhr.statusText;
            //             alert('Terjadi kesalahan: ' + errorMessage);
            //         }
            //     });
            // });
            // $(document).on("click", ".open-edit-dialog", function() {
            //     var guid = $(this).data('guid');
            //     $('#guid').val(guid);
            //     $.ajax({
            //         type: "GET",
            //         url: "{{ env('URL_API') }}/api/v1/form/" + guid,
            //         data: {

            //         },
            //         beforeSend: function(request) {
            //             request.setRequestHeader("Authorization",
            //                 "Bearer {{ $token }}");
            //         },
            //         success: function(result) {
            //             $('#update-name').val(result['data']['name']);
            //             $('#update-description').val(result['data']['description']);
            //             var selectedCategories = JSON.parse(result['data']['category']);

            //             // Uncheck all checkboxes
            //             $('input[name="update-category[]"]').prop('checked', false);

            //             // Check checkboxes based on selectedCategories
            //             selectedCategories.forEach(function(category) {
            //                 $('input[name="update-category[]"][value="' + category +
            //                     '"]').prop('checked', true);
            //             });
            //             $('#update-url-form').val(result['data']['url_form']);
            //             $('#update-url-spreadsheet').val(result['data']['url_spreadsheet']);
            //             $('#modalEdit').modal('show');
            //         },
            //         error: function(xhr, status, error) {
            //             var errorMessage = xhr.status + ': ' + xhr.statusText;
            //             alert('Terjadi kesalahan: ' + errorMessage);
            //         }
            //     });

            // });

            // $('#edit-form').on('submit', function(e) {
            //     e.preventDefault();

            //     var guid = $('#guid').val();
            //     var name = $('#update-name').val();
            //     var description = $('#update-description').val();
            //     var categories = $('input[name="update-category[]"]:checked').map(function() {
            //         return $(this).val();
            //     }).get();
            //     var urlForm = $('#update-url-form').val();
            //     var urlSpreadsheet = $('#update-url-spreadsheet').val();


            //     $.ajax({
            //         type: "PUT",
            //         url: "{{ env('URL_API') }}/api/v1/form",
            //         data: {
            //             "guid": guid,
            //             "name": name,
            //             "description": description,
            //             "category": JSON.stringify(categories),
            //             "url_form": urlForm,
            //             "url_spreadsheet": urlSpreadsheet
            //         },
            //         beforeSend: function(request) {
            //             request.setRequestHeader("Authorization",
            //                 "Bearer {{ $token }}");
            //         },
            //         success: function(result) {
            //             $('#modalEdit').modal('hide');
            //             window.location.href = "{{ route('form') }}";
            //         },
            //         error: function(xhr, status, error) {
            //             var errorMessage = xhr.status + ': ' + xhr.statusText;
            //             alert('Terjadi kesalahan: ' + errorMessage);
            //         }
            //     });
            // });
            // $('#add').click(function() {
            //     $('#modalAdd').modal('show');
            // });

            // $('#add-form').on('submit', function(e) {
            //     e.preventDefault();

            //     var name = $('#add-name').val();
            //     var description = $('#add-description').val();
            //     var categories = $('input[name="add-category[]"]:checked').map(function() {
            //         return $(this).val();
            //     }).get();
            //     var urlForm = $('#add-url-form').val();
            //     var urlSpreadsheet = $('#add-url-spreadsheet').val();

            //     $.ajax({
            //         type: "POST",
            //         url: "{{ env('URL_API') }}/api/v1/form",
            //         data: {
            //             name: name,
            //             description: description,
            //             category: JSON.stringify(categories),
            //             url_form: urlForm,
            //             url_spreadsheet: urlSpreadsheet
            //         },
            //         beforeSend: function(request) {
            //             request.setRequestHeader("Authorization",
            //                 "Bearer {{ $token }}");
            //         },
            //         success: function(result) {
            //             $('#modalAdd').modal('hide');
            //             window.location.href = "{{ route('form') }}";
            //         },
            //         error: function(xhr, status, error) {
            //             var errorMessage = xhr.status + ': ' + xhr.statusText;
            //             alert('Terjadi kesalahan: ' + errorMessage);
            //         }
            //     });
            // });
        });
    </script>
@endsection
