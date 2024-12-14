<div class="row pb-2">
    <div class="col-md-3">
        <div class="form-group">
            <label for="">{{ __('label.category') }}</label>
            <span class="req-star">*</span>
            <select id="category_id" name="category_idfk" class="form-control">
                @isset($categories)
                    <?=selectOptions($categories, old('budget_idfk',$post['category_idfk']))?>
                @endisset
            </select>
            {!! $errors->first('budget_idfk', '<p class="text-danger">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">{{ __('label.code') }}</label>
            <span class="req-star">*</span>
            <input id="code" name="code" class="form-control" autocomplete="off" value="{{ $post['code'] }}" />
            {!! $errors->first('code', '<p class="text-danger">:message</p>') !!}
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="">{{ __('label.name') }}</label>
            <input id="name" name="name" class="form-control" autocomplete="off" value="{{ $post['name'] }}" />
            </div>
    </div>
    <div class="col-md-3">
        <div class="form-group padding-top-10">
            <label for="" class="text-white">{{ __('label.search_label') }}</label><br/>
            <a href="javascript:void(0)" class="btn btn-success btn-sm btnFilter">{{ __('label.filter') }}</a>
        </div>
    </div>
</div>
