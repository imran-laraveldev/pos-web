@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><span class="pull-left">{{ __($title) }}</span>
                <span style="float: right;">
                <a href="#" class="btn btn-success btn-sm create-product"
                   data-url="{{ route($routePrefix.'create_modal') }}"
                   data-bs-toggle="modal" data-bs-target="#actionsModal" >Create</a>
                </span>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-lg-12">
                    <table class="table align-middle p-4 mb-0 listing-tbl">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">Sr #</th>
                            <th scope="col" class="border-0">Parent Nav</th>
                            <th scope="col" class="border-0">Node Name</th>
                            <th scope="col" class="border-0">Sort Order</th>
                            <th scope="col" class="border-0">Schema Name</th>
                            <th scope="col" class="border-0">Status</th>
                            <th scope="col" class="border-0">Created By</th>
                            <th scope="col" class="border-0">Created At</th>
                            <th scope="col" class="border-0">Action</th>
                        </tr>
                        </thead>
                        <!-- Table body START -->
                        <tbody>
                        @if (!blank($rows))
                            @foreach($rows as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row['title'] }}</td>
                                    <td class="text-capitalize">{{ !is_null($row['department']) ? $row['department']['name'] : '--' }}</td>
                                    <td>{{ $row['sector'] }}</td>
                                    <td>{{ $row['sub_sector'] }}</td>
                                    <td>
                                        <a href="{{ route('budget_types.show',[$row->id]) }}" class=""><i
                                                class='bx bx-edit fa fa-eye'></i></a>|
                                        <a href="{{ route('budget_types.edit',[$row->id]) }}" class=""><i
                                                class='bx bx-pencil fa fa-pencil'></i></a>|
                                        <a href="javascript:void(0);"
                                           onclick='verifyCheck("{{ route('budget_types.destroy',[$row->id]) }}")'
                                           class=""><i class='bx bx-trash fa fa-trash'></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-dark text-center h-100px"> No Record Found!</td>
                            </tr>
                        @endif
                        </tbody>
                        <!-- Table body END -->
                    </table>

                </div>
            </div>
        </div>

    </div>
    @include('settings::dynamic_forms.common_modal');

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets-cattle/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-cattle/datepicker/datepicker3.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets-cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets-cattle/cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets-cattle/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('assets-cattle/datepicker/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.listing-tbl').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                async:false,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },

                ajax: {
                    url:"{{ route($routePrefix.'datatable') }}",
                    type:'POST',
                    data: function (d) {
                        d._token = "<?php echo csrf_token(); ?>";
                        d.name = $('#name').val();
                        // d.status=1;
                    }
                },
                columns: [
                    { data: 'id', name: 'id' ,"visible": false},
                    { data: 'navigation_name', name: 'navigation_id', className: "text-center","orderable": true},
                    { data: 'node_name', name: 'node_name' ,"orderable": false},
                    { data: 'node_sort_order', name: 'node_sort_order' ,"orderable": true},
                    { data: 'schema_name', name: 'schema_name' ,"orderable": true},
                    // { data: 'allowed_operations', name: 'allowed_operations' ,"orderable": false},
                    { data: 'status', name: 'status' ,"orderable": false},
                    { data: 'creator_name', name: 'creator_name' ,"orderable": false},
                    { data: 'created_at', name: 'created_at' ,"orderable": false},
                    { data: 'action', name: 'action' ,"orderable": false}
                ],
                "order": [[ 1, "asc" ]],
            });
        });


        function search_data() {
            table = $('.listing-tbl').DataTable();
            table.draw();
        }

        function clear_search_data() {
            $("#form")[0].reset();
            $('#division_id').val(null).trigger('change');
            $('#district_id').empty();
            $('#tehsil_id').empty();

            // $('.chosen-select').trigger("chosen:updated");
            $('.search-filters').find('input:text').val('');
            search_data();
        }

        $('.create-product').on('click', function () {
            console.log('dd click..');
            $('.modal-title').html('New Form: Loading...');

            var modal_title = '{{ substr($title,0,-1)  }}';
            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {"id": 1},
                success: function (response) {
                    $("#actionsModal .model-error-message").text('').hide();
                    $('#actionsModal .model-content-area').html(response);
                    $('.modal-title').html(modal_title);
                    $('#btnModalSave').data('type', 2);

                }
            });
        });

        $("#complaint_form").validate({
            rules: {
                navigation_id: 'required',
                node_name: 'required',
                schema_name: 'required',
            },
            message: {
                navigation_id: "This field is required",
                node_name: "This field is required",
                schema_name: "This field is required",
            },
        });

        $("#btnModalSave").click(function () {
            if ($("#complaint_form").valid()) {
                $.ajax({
                    url: '{{ route($routePrefix.'validate') }}',
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        "navigation_id": $('#navigation_id').val(),
                        "node_name": $('#node_name').val(),
                        "node_sort_order": $('#node_sort_order').val(),
                        "schema_name": $('#schema_name').val(),
                        "allowed_operations": $('#allowed_operations').val(),
                    },
                    success: function (response) {
                        // $('#complaint_form').submit();
                        $.ajax({
                            url: '{{ route($routePrefix.'store') }}',
                            type: 'post',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: {
                                "navigation_id": $('#navigation_id').val(),
                                "node_name": $('#node_name').val(),
                                "node_sort_order": $('#node_sort_order').val(),
                                "schema_name": $('#schema_name').val(),
                                "allowed_operations": $('#allowed_operations').val(),
                            },
                            success: function (response) {
                                $("#actionsModal .model-error-message").text('').hide();
                                $('#btnModalSave').data('type', 1);
                                $("#actionsModal").modal('hide');
                                search_data();
                            },
                            error: function (xhr, status, error) {
                                //console.log(xhr.responseJSON.message,xhr);
                                $("#actionsModal .model-error-message").text(xhr.responseJSON.message).show();
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        //console.log(xhr.responseJSON.message,xhr);
                        $("#actionsModal .model-error-message").text(xhr.responseJSON.message).show();
                    }
                });
            }
        });
    </script>
@endpush

