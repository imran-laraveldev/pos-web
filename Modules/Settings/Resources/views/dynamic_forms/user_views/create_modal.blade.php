
<style>
    .form-control.error{
        border: 1px solid red;
    }
    .form-control.error + .error{
        color: red;
        font-size: .6rem;
    }
</style>
<form id="complaint_form" method="post" action="{{ route($routePrefix.'store-form',$id) }}" enctype="multipart/form-data">
    @csrf
    @foreach($fields as $field)
    <div class="row pb-2">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            {{--<div class="form-group">
                <label for="">{{ $field->label_name }}</label>
                <span class="req-star text-danger">{{ $field->is_required ? '*' : '' }}</span>
                <input type="text" name="{{ $field->field_name }}" id="{{ $field->field_name }}" class="form-control"
                       {{ $field->is_required ? 'required' : '' }} maxlength="{{ $field->field_length }}"
                       value="{{ $field->default_value }}"
                />
                {!! $errors->first($field->field_name, '<p class="text-danger">:message</p>') !!}
            </div>--}}
            @if ($field->control_type == 'select')
                    {!! formControl($field,null,$select[$field->checklist]) !!}
            @else
            {!! formControl($field) !!}
            @endif
        </div>
    </div>
    @endforeach

    {{--<div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">{{ __('label.schema_name') }}</label>
                <span class="req-star">*</span>
                <input type="text" name="schema_name" id="schema_name" value="" class="form-control" required maxlength="100"/>
                {!! $errors->first('schema_name', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">{{ __('label.allowed_operations') }}</label>
                <select id="allowed_operations" name="allowed_operations" class="form-control" required>
                    <?=selectOptions(['all','view','create','update','delete'], old('allowed_operations', 'all'),true) ?>
                </select>
                {!! $errors->first('schema_name', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>--}}
    <hr/>
</form>
