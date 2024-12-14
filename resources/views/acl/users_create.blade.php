@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New User') }}</div>

                    <div class="card-body">
                        <form id="complaint_form" method="post" action="{{ route('acl.user.store') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-12">

                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('label.name') }}</label>
                                        <span class="req-star">*</span>
                                        <input type="text" id="name" name="name" class="form-control"
                                               value="{{ old('name') }}">
                                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('label.email') }}</label>
                                        <span class="req-star">*</span>
                                        <input type="text" id="email" name="email" class="form-control"
                                               value="{{ old('email') }}">
                                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('Password') }}</label>
                                        <span class="req-star">*</span>
                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password" required autocomplete="new-password">
                                        {!! $errors->first('password', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('Confirm Password') }}</label>
                                        <span class="req-star">*</span>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password">
                                        {!! $errors->first('password_confirmation', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4 region-fields">
                                    <div class="form-group">
                                        <label for="">{{ __('label.province') }}</label>
                                        <span class="req-star">*</span>
                                        <select id="province" name="province_idfk" class="form-control">
                                            <?=selectOptions($provinces, old('province_idfk', 6))?>
                                        </select>
                                        {!! $errors->first('province_idfk', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4 society-fields region-fields">
                                    <div class="form-group">
                                        <label for="">{{ __('label.division') }}</label>
                                        <span class="req-star">*</span>
                                        @php
                                            $division_id = old('division_idfk');
                                            $district_id = old('district_idfk');
                                            $tehsil_id = old('tehsil_idfk');
                                        @endphp
                                        <select id="division" name="division_idfk" class="form-control">
                                            <?=selectOptions($divisions, old('division_idfk', $division_id))?>
                                        </select>
                                        {!! $errors->first('division_idfk', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="form-group col-md-4 society-fields region-fields">
                                    <label for="">{{ __('label.district') }}</label>
                                    <span class="req-star">*</span>
                                    <input type="hidden" id="selected_district" value="{{ old('district_idfk', 0) }}">
                                    <select id="district" name="district_idfk" class="form-control">
                                        @if($division_id)
                                            <?=selectOptions([], old('district_idfk', $district_id))?>
                                        @endif
                                    </select>
                                    {!! $errors->first('district_idfk', '<p class="text-danger">:message</p>') !!}
                                </div>

                                <div class="form-group col-md-4 society-fields region-fields">
                                    <label for="">{{ __('label.tehsil') }}</label>
                                    <span class="req-star">*</span>
                                    <input type="hidden" id="selected_tehsil" value="{{ old('tehsil_ids', 0) }}">
                                    <select id="tehsil_id" name="tehsil_ids" class="form-control">
                                        @if($district_id)
                                            {{selectOptions([],old('tehsil_ids', $tehsil_id))}}
                                        @endif
                                    </select>
                                    {!! $errors->first('tehsil_ids', '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-4 mt-2">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="window.open('{{ route('acl.user.listing') }}', '_self')">Cancel</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets-cattle/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets-cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets-cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets-cattle/select2/dist/js/select2.full.js') }}"></script>
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
        }).on('change', function (){
            if ($(this).val() != '' && $(this).siblings("p.text-danger").length) {
                $(this).siblings("p.text-danger").remove();
            }
        });
        $('#password').on('keypress',function (){
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
