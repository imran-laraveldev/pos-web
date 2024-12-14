
<style>
    .form-control.error{
        border: 1px solid red;
    }
    .form-control.error + .error{
        color: red;
        font-size: .6rem;
    }
</style>
<form id="complaint_form" method="post" action="#" >
    @csrf
    @foreach($fields as $field)
    <div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            {{--<div class="form-group">
                <label for="">{{ $field->label_name }}</label>
                <span class="req-star text-danger">{{ $field->is_required ? '*' : '' }}</span>
                <input type="text" name="{{ $field->field_name }}" id="{{ $field->field_name }}" class="form-control"
                       {{ $field->is_required ? 'required' : '' }} maxlength="{{ $field->field_length }}"
                       value="{{ $row->{$field->field_name} ?? $field->default_value }}" />
                {!! $errors->first($field->field_name, '<p class="text-danger">:message</p>') !!}
            </div>--}}
            @if ($field->control_type == 'select')
                {!! formControl($field,$row,$select[$field->checklist]) !!}
            @else
                {!! formControl($field,$row) !!}
            @endif
        </div>
    </div>
    @endforeach

    <hr/>
</form>
