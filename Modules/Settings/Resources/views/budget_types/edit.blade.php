@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Budget Type') }}</div>

            <div class="card-body">
                <form id="complaint_form" method="post" action="{{ route('budget_types.update',$row->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    <div class="col-lg-12">

                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('label.name') }}</label>
                                <span class="req-star">*</span>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ old('name', $row->title) }}">
                                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('label.sector') }}</label>
                                <span class="req-star">*</span>
                                <input type="text" id="sector" name="sector" class="form-control"
                                       value="{{ old('sector', $row->sector) }}">
                                {!! $errors->first('sector', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">{{ __('label.sub_sector') }}</label>
                                <span class="req-star">*</span>
                                <input type="text" id="sub_sector" name="sub_sector" class="form-control"
                                       value="{{ old('sub_sector', $row->sub_sector) }}">
                                {!! $errors->first('sub_sector', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('label.department') }}</label>
                                <span class="req-star">*</span>
                                <select id="department" name="department_idfk" class="form-control">
                                    <?=selectOptions($departments, old('department_idfk', $row->department_idfk))?>
                                </select>
                                {!! $errors->first('department_idfk', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4 mt-2">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-outline-secondary"
                                    onclick="window.open('{{ route('budget_types.index') }}', '_self')">Cancel
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.full.js') }}"></script>
    <script>
        var getAll = 0;
        $("#province").select2({placeholder: "-- Please Select --"}).on('change', function () {
            if ($(this).val() > 0) {
                $url = '<?= URL::to("getDivision") ?>';
                $data = {
                    'province_id': $(this).val(),
                    all: getAll,
                    'csrf_token': $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: $url,
                    type: "POST",
                    dataType: 'text',
                    data: $data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        var obj = $.parseJSON(data);
                        $('#division').empty();
                        $('#division').append(obj.result);

                    }
                });
            }
        });

        $("#division").select2({
            placeholder: "-- Please Select --",

        }).on('change', function () {
            $(this).valid();
            var division_id = $(this).val();
                @if (old('district_id', '0') > 0)
            var district_id = "{{old('district_id','')}}";
                @else
            var district_id = $('#selected_district').val();
            if ($('#selected_district').length == 0) {
                var district_id = $('#district').val();
            }
            @endif
            if ($(this).siblings("p.text-danger").length) {
                $(this).siblings("p.text-danger").remove();
            }
            if (division_id > 0) {
                $url = '<?= URL::to("getDistrict") ?>';
                $data = {
                    'division_id': division_id,
                    'district_id': district_id,
                    all: getAll,
                    'csrf_token': $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: $url,
                    type: "POST",
                    dataType: 'text',
                    data: $data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        var obj = $.parseJSON(data);
                        $('#district').empty();
                        $('#tehsil_id').empty();
                        $('#district').append(obj.result);

                    }
                });
            }
        });


        /*---------Get All LG by district Id--------*/
        $("#district").select2({
            // placeholder: "-- Please Select --",
        }).on('change', function () {
            $(this).valid();
            var division_id = $("#division").val();
            var district_id = $(this).val();
            var tehsil_id = $("#selected_tehsil").val();
            if (district_id != '') {
                if ($(this).siblings("p.text-danger").length) {
                    $(this).siblings("p.text-danger").remove();
                }
            }

            $url = '<?= URL::to("getTehsil") ?>';
            $data = {'district_id': district_id, 'division_id': division_id, 'tehsil_id': tehsil_id, all: getAll};
            $.ajax({
                url: $url,
                type: "POST",
                dataType: 'text',
                data: $data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    var obj = $.parseJSON(data);
                    $('#tehsil_id').empty();
                    $('#tehsil_id').append(obj.result);

                }
            });
        });

        $("#tehsil_id").select2({
            // placeholder: "-- Please Select --",
            // dropdownAutoWidth: true
        }).on('change', function () {
            if ($(this).val() != '' && $(this).siblings("p.text-danger").length) {
                $(this).siblings("p.text-danger").remove();
            }
        });
        $('#password').on('keypress', function () {
            if ($(this).val() != '' && $(this).siblings("p.text-danger").length) {
                $(this).siblings("p.text-danger").remove();
            }
        })
        <?php if (old('district_idfk', 0) > 0) { ?>
        $('#division').trigger('change');
        <?php } ?>
        @if (old('tehsil_ids', 0) > 0)
        $('#district').trigger('change');
        @endif
    </script>
@endpush
