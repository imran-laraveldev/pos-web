    <div class="row">
        <div class="col-md-12">
            <p class="page-sec-head">Enter Role Detail</p>
        </div>
    </div>
    <div class="row">
        <form id="roleCreateForm" method="post" target="{{ route('acl.role.store') }}" accept-charset="UTF-8" >
            @csrf
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="">{{ __('label.name') }}</label>
                <span class="req-star">*</span>
                <input type="text" id="name" name="name" class="form-control"
                       value="{{ old('name') }}">
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
        </form>
    </div>
