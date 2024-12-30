<style>
    .form-control.error {
        border: 1px solid red;
    }

    .form-control.error + .error {
        color: red;
        font-size: .6rem;
    }
</style>
<form id="student_form" method="post" action="{{ route($routePrefix.'store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row ml-5">
        <div class="row mt-1">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{ __('schools::label.student_name') }}</label>
                    <span class="req-star text-danger">*</span>
                    <input type="text" id="student_name" name="student_name" class="form-control"
                           value="{{ old('student_name', '') }}">
                    {!! $errors->first('student_name', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{ __('schools::label.father_name') }}</label>
                    <span class="req-star text-danger">*</span>
                    <input type="text" id="father_name" name="father_name" class="form-control"
                           value="{{ old('father_name', '') }}">
                    {!! $errors->first('father_name', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="hidden" id="admission_number_F" value="{{ $admission_number[0]['num'] ?? '' }}">
                    <input type="hidden" id="admission_number_M" value="{{ $admission_number[1]['num'] ?? '' }}">
                    <label for="admission_number">{{ __('schools::label.admission_number') }}</label>
                    <input type="text" id="admission_number_form" name="admission_number" class="form-control text-success"
                           value="{{ old('admission_number', $admission_number[0]['num'] ?? '') }}">
                    {!! $errors->first('admission_number', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">{{ __('schools::label.date_of_birth') }}</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control"
                           value="{{ old('date_of_birth', date('Y-m-d', strtotime('-14 years'))) }}">
                    {!! $errors->first('date_of_birth', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <label for="course_id" class="mb-0 mr-2">{{ __('schools::label.class') }}</label>
                <div class="form-group d-flex align-items-center">

                    <select class="form-select mr-2 flex-grow-1" id="course_id" name="course_id">
                        {{ selectOptions($courses, old('course_id', 9), false, false) }}
                    </select>
                    <input type="text" id="section" name="section" class="form-control"
                           value="{{ old('section', 'A') }}" style="width: 60px;">
                    {!! $errors->first('course_id', '<p class="text-danger w-100">:message</p>') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">{{ __('schools::label.contact') }}</label>
                    <input type="text" id="cell_phone_father" name="cell_phone_father" class="form-control text-danger"
                           value="{{ old('cell_phone_father', '') }}">
                    {!! $errors->first('cell_phone_father', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">{{ __('schools::label.address') }}</label>
                    <input type="text" id="address_line1" name="address_line1" class="form-control"
                           value="{{ old('address_line1','') }}">
                    {!! $errors->first('address_line1', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="">{{ __('schools::label.batch') }}</label>
                    <select class="form-select" id="batch_id" name="batch_id">
                        {{ selectOptions($batches,old('batch_id', $batch_id),false,false) }}
                    </select>
                    {!! $errors->first('batch_id', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">{{ __('schools::label.gender') }}</label>
                    <select class="form-select" id="gender" name="gender" onchange="setAdmissionNumber(this.value)">
                        {{ selectOptions($genders,old('gender', $default_gender),false,false) }}
                    </select>
                    {!! $errors->first('gender', '<p class="text-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-3">
                <label for="available-subjects">Available Subjects</label>
            </div>
            <div class="col-md-3 mr-5">
                <label for="available-subjects">Selected Subjects</label>
            </div>
            <div class="col-md-2 mr-4">
                <label for="available-subjects">{{ __('schools::label.gender') }}</label>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-4">
                <div class="multiselect-box">
                    <select class="multi-select" id="availableSubjects" name="availableSubjects[]" multiple>
                        {{ selectOptions($subjects,$selectedSubject,false,false) }}
                    </select>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <hr/>
</form>
<script>
    function setAdmissionNumber(val) {
        var num = $('#admission_number_'+val).val();
        $('#admission_number_form').val(num);
    }
</script>
