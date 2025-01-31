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
                    <table class="table align-middle p-4 mb-0 products-tbl">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">Sr #</th>
                            <th scope="col" class="border-0">Category</th>
                            <th scope="col" class="border-0"></th>
                            <th scope="col" class="border-0">Code</th>
                            <th scope="col" class="border-0">Name</th>
                            <th scope="col" class="border-0">Sale Price</th>
                            <th scope="col" class="border-0">Vendor</th>
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
                                <td colspan="6" class="text-dark text-center h-100px"> No Record Found!</td>
                            </tr>
                        @endif
                        </tbody>
                        <!-- Table body END -->
                    </table>

                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="actionsModal" tabindex="-1" role="dialog" aria-labelledby="actionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionsModalLabel">Modal Loading...</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 model-error-message text-danger" style="display:none;"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 model-content-area" >Loading ...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  id="btnModalSave" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
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

            $('.products-tbl').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                async:false,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },

                ajax: {
                    url:"{{ route('products.datatable') }}",
                    type:'POST',
                    data: function (d) {
                        d._token = "<?php echo csrf_token(); ?>";
                        d.name = $('#name').val();
                        d.vendor = $('#vendor').val();
                        d.department = $('#department').val();
                        // d.status=1;
                    }
                },
                columns: [
                    { data: 'id', name: 'inventory_id' ,"visible": false},
                    { data: 'department_name', name: 'department_id', className: "text-center","orderable": true},
                    { data: 'color_box', name: 'color_code' ,"orderable": false},
                    { data: 'code', name: 'code' ,"orderable": true},
                    { data: 'inventory_name', name: 'title' ,"orderable": true},
                    { data: 'sale_price', name: 'sale_price' ,"orderable": false},
                    { data: 'vendor_name', name: 'vendor_id', "orderable": false},
                    { data: 'action', name: 'action' ,"orderable": false}
                ],
                "order": [[ 1, "asc" ]],
            });
        });


        function search_data() {
            table = $('#complaint-listing').DataTable();
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
            $('.modal-title').html('New Product: Loading...');

            var modal_title = '{{ __('label.product') }}';
            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {"id": 1},
                success: function (response) {
                    $('#actionsModal .model-content-area').html(response);
                    $('.modal-title').html(modal_title);
                    $('#btnModalSave').data('type', 2);

                }
            });
        });

        $("#complaint_form").validate({
            rules: {
                financial_year_idfk: 'required',
                budget_idfk: 'required',
                scheme_id: 'required',
            },
            message: {
                financial_year_idfk: "This field is required",
                budget_idfk: "This field is required",
                scheme_id: "This field is required",
            },
        });

        $("#btnModalSave").click(function () {
            if ($("#complaint_form").valid()) {
                $.ajax({
                    url: '{{ route('products.validate') }}',
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        "financial_year_idfk": $('#financial_year_id').val(),
                    },
                    success: function (response) {
                        $('#complaint_form').submit();
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

