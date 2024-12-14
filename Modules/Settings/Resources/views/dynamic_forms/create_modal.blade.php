
<style>
    .form-control.error{
        border: 1px solid red;
    }
    .form-control.error + .error{
        color: red;
        font-size: .6rem;
    }
</style>
<form id="complaint_form" method="post" action="{{ route($routePrefix.'store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">{{ __('label.parent_nav') }}</label>
                <span class="req-star">*</span>
                <select id="navigation_id" name="navigation_id" class="form-control" required>
                    <?=selectOptions($navigations, old('navigation_id', 0)) ?>
                </select>
                {!! $errors->first('navigation_id', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">{{ __('label.node_name') }}</label>
                <span class="req-star">*</span>
                <input type="text" name="node_name" id="node_name" value="" class="form-control" required
                       maxlength="100"/>
                {!! $errors->first('node_name', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="">{{ __('label.sort_order') }}</label>
                <input type="number" min="1" max="10" name="node_sort_order" id="node_sort_order" value="1" class="form-control" />
                {!! $errors->first('node_sort_order', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>

    </div>
    <div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">{{ __('label.schema_name') }}</label>
                <span class="req-star text-danger">*</span>
                <input type="text" name="schema_name" id="schema_name" value="" class="form-control" required maxlength="100"/>
                {!! $errors->first('schema_name', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="">{{ __('label.form_type') }}</label>
                <span class="req-star text-danger">*</span>
                <select name="form_type" id="form_type" class="form-control" required >
                    <option value="1" selected>Listing</option>
                    <option value="2">Dropdown</option>
                </select>
                {!! $errors->first('form_type', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">{{ __('label.allowed_operations') }}</label>
                <select id="allowed_operations" name="allowed_operations" class="form-control" required>
                    <?=selectOptions(['all','view','create','update','delete'], old('allowed_operations', 'all'),true) ?>
                </select>
                {!! $errors->first('schema_name', '<p class="text-danger">:message</p>') !!}
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

    </div>
    <hr/>
</form>
