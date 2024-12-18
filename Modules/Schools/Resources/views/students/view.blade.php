@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Student') }} View</div>

            <div class="card-body">
                <form id="student_form" method="post" action="{{ route($routePrefix .'update', $row->student_id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $row->student_id }}">

                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.student_name') }}</label>
                                <span class="req-star text-danger">*</span>
                                <input type="text" id="student_name" name="student_name" class="form-control"
                                       value="{{ old('student_name', $row->student_name) }}">
                                {!! $errors->first('student_name', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.father_name') }}</label>
                                <span class="req-star text-danger">*</span>
                                <input type="text" id="father_name" name="father_name" class="form-control"
                                       value="{{ old('father_name', $row->father_name) }}">
                                {!! $errors->first('father_name', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.date_of_birth') }}</label>
                                <input type="text" id="date_of_birth" name="date_of_birth" class="form-control"
                                       value="{{ old('date_of_birth', $row->date_of_birth) }}">
                                {!! $errors->first('date_of_birth', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.class') }}</label>
                                <input type="text" id="class" name="class" class="form-control"
                                       value="{{ old('class', $row->class) }}">
                                {!! $errors->first('class', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.contact') }}</label>
                                <input type="text" id="cell_phone_father" name="cell_phone_father" class="form-control"
                                       value="{{ old('cell_phone_father', $row->cell_phone_father) }}">
                                {!! $errors->first('cell_phone_father', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.address') }}</label>
                                <input type="text" id="address_line1" name="address_line1" class="form-control"
                                       value="{{ old('address_line1', $row->address_line1) }}">
                                {!! $errors->first('address_line1', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.admission_number') }}</label>
                                <input type="text" id="class" name="class" class="form-control"
                                       value="{{ old('class', $row->admission_number) }}">
                                {!! $errors->first('class', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <div class="container">

                                <div class="multiselect-container">
                                    <!-- Available Subjects -->
                                    <div class="multiselect-box">
                                        <label for="available-subjects">Available Subjects</label>
                                        <select id="available-subjects" multiple>
                                            {{ selectOptions($subjects,false,false,false) }}
                                        </select>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="action-buttons text-center">
                                        <button type="button" id="move-to-selected" class="btn btn-primary">>></button>
                                        <br><br>
                                        <button type="button" id="move-to-available" class="btn btn-danger"><<</button>
                                    </div>

                                    <!-- Selected Subjects -->
                                    <div class="multiselect-box">
                                        <label for="selected-subjects">Selected Subjects</label>
                                        <select id="selected-subjects" class="multi-select" multiple>
                                            {{ selectOptions($subjects,[],false,false) }}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-top: 10px"/>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('label.department') }}</label>
                                <span class="req-star">*</span>
                                <select id="department" name="department_idfk" class="form-control">
                                    <!--                                    --><?//=selectOptions($departments, old('department_idfk', $row->department_idfk))?>
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
                            <button type="button" class="btn btn-outline-secondary"
                                    onclick="window.open('{{ route($routePrefix.'index') }}', '_self')">Cancel
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
    <style>
        .multiselect-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .multiselect-box {
            width: 45%;
        }
        select {
            height: 200px;
            width: 100%;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.full.js') }}"></script>

    <script>
        $(document).ready(function () {
            // Move selected items to the "Selected Subjects" list
            $('#move-to-selected').on('click', function () {
                $('#available-subjects option:selected').appendTo('#selected-subjects');
            });

            // Move selected items back to the "Available Subjects" list
            $('#move-to-available').on('click', function () {
                $('#selected-subjects option:selected').appendTo('#available-subjects');
            });
        });
    </script>
@endpush
