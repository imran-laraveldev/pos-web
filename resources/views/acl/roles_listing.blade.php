@extends('layouts.app')

@section('content')
    @include('common.alerts')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><span class="pull-left">{{ __('Roles List') }}</span>
                        <span style="float: right;">
{{--                                                <a href="{{ route('acl.user.create') }}" class="btn btn-success btn-sm">Create</a></span>--}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="col-lg-12">
                            <table class="table align-middle p-4 mb-0 roles-tbl">
                                <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Role Name</th>
                                    <th>Permissions</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('style')

@endpush

@push('scripts')
    <script>

        $(document).ready(function () {
            console.log('testing');

            function search_data() {
                table = $('.roles-tbl').DataTable();
                table.draw();
            }

            $('.roles-tbl').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                async: true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },

                ajax: {
                    url: "{{ route('acl.role.datatable') }}",
                    type: 'POST',
                    data: function (d) {
                        d._token = "<?php echo csrf_token(); ?>";
                        d.name = '';
                        // d.name = $('#txtexecutor').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id', "visible": true, class: 'text-center'},
                    {data: 'name', name: 'name', "orderable": true, class: 'col-md-2'},
                    {data: 'permissions', name: 'permissions', "orderable": false},
                    {data: 'action', name: 'action', "orderable": false, class: 'col-md-2'}
                ],
                "order": [[1, "asc"]],
            });

            $('.create-role').on('click', function (e) {
                console.log("Showing action modal..");

                $.ajax({
                    url: '<?php echo URL::to('acl/role/create'); ?>',
                    type: 'get',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (response) {
                        $('#actions_modal .fetched-data').html(response);
                        $('#model-heading').html('Create Role...');
                        $('#btnSave').data('type', 1);

                        // $('select[name="department_idFk"]').on('click', function (){
                        //
                        // });
                    }
                });

            });


            $('.delete-role').on('click', function (e) {
                var del_link = $(this).data('del-link');
                console.log("deleting role form.." + del_link);
            });

            $('#btnSave').on('click', function (e) {

                var type = $(this).data('type');
                var nameField = $('#name').val();
                if (type > 0) {
                    if (nameField == '') {
                        $('#model-error-message').html('Please select name');
                        $('#model-error-message').show();
                        $('#name').focus();
                        return false;
                    } else {
                        $('#model-error-message').html('');
                    }

                    if (type == 1) {
                        route_url = '{{ route('acl.role.store') }}';
                        var form = $('#roleCreateForm')[0];
                        var formData = new FormData(form);
                        // var formData = {
                        //     "name": nameField,
                        // };
                        event.preventDefault();
                        $.ajax({
                            url: route_url,
                            type: 'post',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: formData,
                            async: false,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                response = JSON.parse(response);
                                if (response['success']) {
                                    $('#actions_modal .fetched-data').html(response['success_message']);
                                    // location.reload();
                                    $('.users-tbl').DataTable().draw();
                                    $('#actions_modal').modal('hide');
                                }
                            },
                            error: function (data) {
                                $('.error-content').html(data);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
