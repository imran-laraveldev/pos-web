@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><span class="pull-left">{{ __($title) }}</span>
                <span style="float: right;">
                <a href="#" class="btn btn-success btn-sm create-product" data-type="1"
                   data-url="{{ route($routePrefix.'create-form',$id) }}"
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
                            @foreach($fields as $field)
                                @if ($field->visible_list == '0')
                                    @continue
                                @endif
                                <th scope="col" class="border-0">{{ $field->label_name }}</th>
                            @endforeach
                            <th scope="col" class="border-0">Action</th>
                        </tr>
                        </thead>
                        <!-- Table body START -->
                        <tbody>
                        @if (!blank($rows))
                            @foreach($rows as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    @foreach($fields as $field)
                                        @if ($field->visible_list == '0')
                                            @continue
                                        @endif
                                        @if ($field->control_type == 'select')
                                            <td>{{ $select[$field->checklist][$row->{$field->field_name}] ?? '--' }}</td>
                                        @else
                                            <td>{{ $row->{$field->field_name} }}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <a href="javascript:void(0);" class="create-product" data-type="2"
                                           data-url="{{ route($routePrefix.'edit-form',[$id,$row->id]) }}"
                                           data-bs-toggle="modal" data-bs-target="#actionsModal" ><i
                                                class='bx bx-pencil'></i></a>|

                                        <a href="javascript:void(0);" class="create-product" data-type="3"
                                           data-url="{{ route($routePrefix.'show-form',[$id,$row->id]) }}"
                                           data-bs-toggle="modal" data-bs-target="#actionsModal"
                                        ><i class='bx bx-edit'></i></a>|

                                        <a onclick='verifyCheck("{{ route($routePrefix.'destroy-entry',[$id,$row->id]) }}")'
                                           href="javascript:void(0);"><i class='bx bx-trash'></i></a>
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
    @include('settings::dynamic_forms.common_modal')

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
                pageLength: 30
            });
            $('.listing-tbl-1').DataTable({
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

        function show_message(message_container, alertCls, message) {
            $("#" + message_container).removeClass('alert alert-danger alert alert-success')
                .addClass('alert alert-' + alertCls).text(message).show();
            $('html, body').animate({
                scrollTop: $("#" + message_container).offset().top
            }, 1000);
            setTimeout(
                function() {
                    $("#" + message_container).hide();
                }, 2000
            );
        }

        function search_data() {
            // show_message('notification_alert', 'danger', 'Sorry this record id is not found.');
            parent.location.reload();
            // for server side datatable
            // table = $('.listing-tbl').DataTable();
            // table.draw();
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
            var link_type = $(this).data('type');
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
                    $('#btnModalSave').data('type', link_type);
                    if (link_type === 1) {
                        $('#btnModalSave').html('Save').removeClass('d-none');
                    } else if (link_type === 2) {
                        $('#btnModalSave').html('Update').removeClass('d-none');
                    }
                    if (link_type === 3) {
                        $('#btnModalSave').addClass('d-none');
                    }

                }
            });
        });

        $("#btnModalSave").click(function () {
            if ($("#complaint_form").valid()) {
                $.ajax({
                    url: '{{ route($routePrefix.'validate') }}',
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: $("#complaint_form").serialize(),
                    success: function (response) {
                        // $('#complaint_form').submit();
                        var btnType = $('#btnModalSave').data('type');
                        var ajaxUrl = (btnType === 1) ? '{{ route($routePrefix.'store-form',$id) }}' :
                            '{{ route($routePrefix.'update-form',$id) }}';
                        console.log('url ==> ' + ajaxUrl);
                        $.ajax({
                            url: ajaxUrl,
                            type: 'post',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: $("#complaint_form").serialize(),
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

