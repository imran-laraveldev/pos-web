@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Student') }} - {{ $row->student_id }}</div>

            <div class="card-body">
                <form id="complaint_form" method="post" action="{{ route($routePrefix .'update', $row->student_id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $row->student_id }}">
                    <input type="hidden" id="redirect_url" name="redirect_url" value="{{ $routePrefix .'index' }}">
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="admission_number">{{ __('schools::label.admission_number') }}</label>
                                <input type="text" id="admission_number" name="class" class="form-control text-success"
                                       value="{{ old('admission_number', $row->admission_number) }}">
                                {!! $errors->first('admission_number', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.date_of_birth') }}</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
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

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.contact') }}</label>
                                <input type="text" id="cell_phone_father" name="cell_phone_father" class="form-control text-danger"
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">{{ __('schools::label.batch') }}</label>
                                <select class="form-select" id="batch_id" name="batch_id">
                                    {{ selectOptions($batches,old('batch_id', $row->batch_id),false,false) }}
                                </select>
                                {!! $errors->first('batch_id', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <label for="available-subjects">Available Subjects</label>
                        </div>
                        <div class="col-md-2">
                            <label for="available-subjects">Selected Subjects</label>
                        </div>
                        <div class="col-md-2">
                            <label for="available-subjects">{{ __('schools::label.gender') }}</label>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">
                            <div class="multiselect-box">
                                <select class="multi-select" id="availableSubjects" name="availableSubjects[]" multiple>
                                    {{ selectOptions($subjects,$selectedSubject,false,false) }}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select class="form-select" id="gender" name="gender">
                                    {{ selectOptions($genders,old('gender', $row->gender),false,false) }}
                                </select>
                                {!! $errors->first('gender', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-1"></div>
                        <div class="col-md-4">

                        </div>
                    </div>
                    <hr style="margin-top: 10px"/>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4 mt-2">
                            <button type="submit" class="btn btn-success">Submit</button>
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
    <link rel="stylesheet" href="{{ asset('Modules/Schools/js/jquery-multi-select/css/multi-select.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.full.js') }}"></script>
    <script src="{{ asset('Modules/Schools/js/jquery-multi-select/js/jquery.multi-select.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#availableSubjects').multiSelect();
        });
    </script>
@endpush
