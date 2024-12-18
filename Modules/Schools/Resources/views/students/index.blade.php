@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="pull-left">Filters</span>
                <span style="float: right;">
            <!-- Optional Actions -->
        </span>
            </div>

            <div class="card-body">
                <form id="complaint_form">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <label for="student_name">Student Name</label>
                            <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="father_name">Father Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="admission_number">Reg #</label>
                            <input type="text" class="form-control" id="admission_number" name="admission_number" \
                                   value="{{ old('admission_number') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="contact">Contact #</label>
                            <input type="text" class="form-control" id="contact" name="contact" \
                                   value="{{ old('contact') }}">
                        </div>
                        <div class="col-md-2 mt-4">
                            <button type="button" class="btn btn-primary btn-sm" id="btn-filter">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
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
                            <th scope="col" class="border-0">Student Name</th>
                            <th scope="col" class="border-0">Father Name</th>
                            <th scope="col" class="border-0">Reg #</th>
                            <th scope="col" class="border-0">Class</th>
                            <th scope="col" class="border-0">Contact</th>
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
                    url:"{{ route($routePrefix.'datatable') }}",
                    type:'POST',
                    data: function (d) {
                        d._token = "<?php echo csrf_token(); ?>";
                        d.student_name = $('#student_name').val();
                        d.father_name = $('#father_name').val();
                        d.admission_number = $('#admission_number').val();
                        d.contact = $('#contact').val();
                        d.student_type = '{{ $student_type }}';
                        d.batch_id = '{{ $batch_id }}';
                    }
                },
                columns: [
                    { data: 'student_id', name: 'student_id' ,"visible": false},
                    { data: 'student_name', name: 'student_name', className: "text-left","orderable": true},
                    { data: 'father_name', name: 'father_name' ,"orderable": true},
                    { data: 'admission_number', name: 'admission_number' ,"orderable": true},
                    { data: 'class', name: 'course_id' ,"orderable": true},
                    { data: 'cell_phone_father', name: 'cell_phone_father' ,"orderable": false},
                    { data: 'action', name: 'action' ,"orderable": false}
                ],
                "order": [[ 1, "asc" ]],
            });
        });


        function search_data() {
            table = $('.products-tbl').DataTable();
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
                student_name: 'required',
            },
            message: {
                student_name: "This field is required",
            },
        });

        $("#btn-filter").on('click', function () {
            search_data();
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

