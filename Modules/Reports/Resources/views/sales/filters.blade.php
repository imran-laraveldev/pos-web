<div class="row pb-2">
    <div class="col-md-3">
        <div class="form-group">
            <label for="">{{ __('label.login_user') }}</label>
            <span class="req-star">*</span>
            <select id="user_id" name="user_id" class="form-control">
                @isset($users)
                    <?=selectOptions($users, old('user_id',$post['user_id']))?>
                @endisset
            </select>
            {!! $errors->first('budget_idfk', '<p class="text-danger">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">{{ __('label.search_date') }}</label>
            <span class="req-star">*</span>
            <input id="search_date" name="search_date" class="form-control" autocomplete="off" value="{{ $post['search_date'] }}" />
            {!! $errors->first('search_date', '<p class="text-danger">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">{{ __('label.reference_number') }}</label>
            <input id="reference_number" name="reference_number" class="form-control" autocomplete="off"
                   value="{{ $post['reference_number'] }}" />
            </div>
    </div>
    <div class="col-md-3">
        <div class="form-group padding-top-10">
            <label for="" class="text-white">{{ __('label.search_label') }}</label><br/>
            <a href="javascript:void(0)" class="btn btn-success btn-sm btnFilter">{{ __('label.filter') }}</a>
        </div>
    </div>
</div>
