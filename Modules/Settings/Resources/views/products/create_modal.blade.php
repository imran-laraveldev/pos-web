
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
                <label for="">{{ __('label.financial_year') }}</label>
                <span class="req-star">*</span>
                <select id="financial_year_id" name="financial_year_idfk" class="form-control" required>
<!--                    --><?//=selectOptions($financialYears, old('financial_year_idfk', 0))?>
                </select>
                {!! $errors->first('financial_year', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>
    <div class="row pb-2 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">{{ __('label.budget') }}</label>
                <span class="req-star">*</span>
                <select id="budget_id" name="budget_idfk" class="form-control" required>
                    @isset($budgets)
                        <?=selectOptions($budgets, old('budget_idfk',0))?>
                    @endisset
                </select>
                {!! $errors->first('budget_idfk', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">{{ __('label.sne_scheme') }}</label>
                <span class="req-star">*</span>
                <select id="scheme_id" name="scheme_id" class="form-control" required>
                    @isset($schemes)
                        <?=selectOptions($schemes, old('scheme_id'))?>
                    @endisset
                </select>
                {{-- <select id="sne_scheme" name="sne_scheme" class="form-control" required>
                    <option value="regular" selected>Regular</option>
                    <option value="Continued(C)">Continued(C)</option>
                    <option value="Fresh(F)">Fresh(F)</option>
                </select> --}}
                {!! $errors->first('scheme_id', '<p class="text-danger">:message</p>') !!}
            </div>
        </div>
    </div>

    <hr/>
</form>
