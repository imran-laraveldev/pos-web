@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Detail Form') }}</div>

            <div class="card-body">
                <form id="complaint_form" method="post" action="{{ route($routePrefix.'update',$row->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    <div class="col-lg-12">

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('label.parent_nav') }}</label>
                                <span class="req-star text-danger">*</span>
                                <select id="navigation_id" name="navigation_id" class="form-control" >
                                    <?=selectOptions($navigations, old('navigation_id', $row->navigation_id)) ?>
                                </select>
                                {!! $errors->first('navigation_id', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('label.node_name') }}</label>
                                <span class="req-star text-danger">*</span>
                                <input type="text" name="node_name" id="node_name" value="{{ $row->node_name }}" class="form-control" required
                                       maxlength="100"/>
                                {!! $errors->first('node_name', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('label.sort_order') }}</label>
                                <input type="number" min="1" max="10" name="node_sort_order" id="node_sort_order" value="{{ $row->node_sort_order }}" class="form-control" />
                                {!! $errors->first('node_sort_order', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('label.allowed_operations') }}</label>
                                <select id="allowed_operations" name="allowed_operations" class="form-control" required>
                                    <?=selectOptions(['all','view','create','update','delete'], $row->allowed_operations,true) ?>
                                </select>
                                {!! $errors->first('allowed_operations', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row pb-2 mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('label.schema_name') }}</label>
                                <span class="req-star text-danger">*</span>
                                <input type="text" name="schema_name" id="schema_name" value="{{ $row->schema_name }}" class="form-control" required maxlength="100"/>
                                {!! $errors->first('schema_name', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('label.form_type') }}</label>
                                <select name="form_type" id="form_type" class="form-control" required >
                                    <option value="1" {{ $row->form_type == '1' ? 'selected':'' }}>Listing</option>
                                    <option value="2" {{ $row->form_type == '2' ? 'selected':'' }}>Dropdown</option>
                                </select>
                                {!! $errors->first('form_type', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('label.pagination') }}</label>
                                <select name="pagination" id="pagination" class="form-control" required >
                                    <option value="1" selected>Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                                {!! $errors->first('pagination', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('label.activate_workflow') }}</label>
                                <select name="activate_workflow" id="activate_workflow" class="form-control" required >
                                    <option value="1" >Enable</option>
                                    <option value="0" selected>Disable</option>
                                </select>
                                {!! $errors->first('activate_workflow', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('label.soft_delete') }}</label>
                                <select id="soft_delete" name="soft_delete" class="form-control" required>
                                    <option value="1" >Enable</option>
                                    <option value="0" selected>Disable</option>
                                </select>
                                {!! $errors->first('soft_delete', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="text-decoration-underline text-uppercase">{{ __('label.prepare_table_schema') }}</label>
                        </div>
                        <div class="col-md-2 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-success btn-sm" id="addRowBtn"> + </button></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <table class="table table-bordered table-full-width" id="detail-tbl">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Field Name</th>
                                            <th>Type</th>
                                            <th>Length</th>
                                            <th>Control</th>
                                            <th>Label</th>
                                            <th>Req</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($row->formEntries as $i => $entry)
                                        <tr {{ $i > 0 ? '' : 'id=inputRow' }} >
                                            <td class="row-number">{{ $i+1 }}</td>
                                            <td><input type="text" name="field_name[]" maxlength="100" class="form-control"
                                                       value="{{ $entry->field_name }}" required/></td>
                                            <td class="col-md-2">
                                                <select name="field_type[]" class="form-control">
                                                    {!! selectOptions(['integer','float','varchar','text','boolean','date','datetime'], old('field_type',$entry->field_type),true)  !!}
                                                </select>
                                            </td>
                                            <td class="col-md-1"><input type="numeric" name="field_length[]" min="1" max="255"
                                                                        class="form-control" value="{{ old('field_length',$entry->field_length) }}" /></td>
                                            <td class="col-md-2">
                                                <select name="control_type[]" class="form-control">
                                                    {!! selectOptions(['text','numeric','select','textarea','checkbox','radio','date','datetime'],old('control_type',$entry->control_type),true)  !!}
                                                </select>
                                                <select name="checklist[]" class="form-control">
                                                    {!! selectOptions($dropdowns,old('checklist',$entry->checklist),true)  !!}
                                                </select>
                                            </td>
                                            <td><input type="text" name="label_name[]" maxlength="100" class="form-control"
                                                       value="{{ old('label_name',$entry->label_name) }}" /></td>
                                            <td><input type="checkbox" name="is_required[]" maxlength="100" class="checkbox"
                                                       value="{{ old('is_required',$entry->is_required) }}" {{ ($entry->is_required) ? 'checked' : '' }} /></td>
                                            <td class="col-md-1 nowrap">
                                                <button type="button" class="btn btn-secondary btn-sm delete-row {{ $i > 0 ? '' : 'd-none' }}"> x </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr id="inputRow">
                                            <td class="row-number">1</td>
                                            <td><input type="text" name="field_name[]" maxlength="100" class="form-control"
                                                       value="name" required/></td>
                                            <td class="col-md-2">
                                                <select name="field_type[]" class="form-control">
                                                    {!! selectOptions(['integer','float','varchar','text','boolean'], old('field_type','varchar'),true)  !!}
                                                </select>
                                            </td>
                                            <td class="col-md-2"><input type="numeric" name="field_length[]" min="1" max="255"
                                                                        class="form-control" value="{{ old('field_length','100') }}" /></td>
                                            <td class="col-md-2">
                                                <select name="control_type[]" class="form-control">
                                                    {!! selectOptions(['text','numeric','select','textarea','checkbox','radio'],old('control_type','text'),true)  !!}
                                                </select>

                                                <select name="checklist[]" class="form-control">
                                                    {!! selectOptions($dropdowns,old('checklist',''),true)  !!}
                                                </select>
                                            </td>
                                            <td><input type="text" name="label_name[]" maxlength="100" class="form-control"
                                                       value="{{ old('label_name','Name') }}" /></td>
                                            <td><input type="checkbox" name="is_required[]" maxlength="100" class="checkbox"
                                                       value="{{ old('is_required','Name') }}" /></td>
                                            <td class="col-md-1 nowrap">
                                                <button type="button" class="btn btn-secondary btn-sm delete-row d-none"> x </button>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr/>

                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-outline-warning"
                                    onclick="window.open('{{ route(substr($routePrefix,0,-1)) }}', '_self')">Cancel
                            </button>
                            @if ($row->migrate === 0)
                            <button type="button" class="btn btn-outline-secondary run-migration"
                                    data-url="{{ route($routePrefix.'migrate', $row->id) }}"
                                    data-bs-toggle="modal" data-bs-target="#actionsModal" > Migration </button>
                            @else
                                <button type="button" class="btn btn-outline-primary">Migrated</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('settings::dynamic_forms.common_modal');
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.full.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#addRowBtn").click(function(){
                var newRow = $("#inputRow").clone();
                var rowCount = $("#detail-tbl tbody tr").length + 1;
                // Update row number
                newRow.find('.row-number').text(rowCount);
                newRow.find('.delete-row').removeClass('d-none');
                // Clear input and select values
                newRow.find('input').val(''); // Clear input and select values
                newRow.find('select[name="field_type[]"]').val('varchar'); // Clear input and select values
                newRow.find('select[name="control_type[]"]').val('text'); // Clear input and select values
                $("#detail-tbl tbody").append(newRow);
            });

            $(document).on("click", ".delete-row", function(){
                $(this).closest('tr').remove();
                // Update row numbers after deletion
                updateRowNumbers();
            });

            // Function to update row numbers
            function updateRowNumbers() {
                $("#detail-tbl tbody tr").each(function (index) {
                    $(this).find('.row-number').text(index + 1);
                });
            }
        });
    </script>
    <script>
        $('.run-migration').on('click', function () {
            console.log('run-migration click..');
            $('.modal-title').html('New Migration: Loading...');

            var modal_title = '{{ substr($title,0,-1)  }}';
            $.ajax({
                url: $(this).data('url'),
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {"id": $('input[name="name"]').val()},
                success: function (response) {
                    $("#actionsModal .model-error-message").text('').hide();
                    $('#actionsModal .model-content-area').html(response);
                    $('.modal-title').html(modal_title);
                    $('#btnModalSave').data('type', 2);

                }
            });
        });

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
