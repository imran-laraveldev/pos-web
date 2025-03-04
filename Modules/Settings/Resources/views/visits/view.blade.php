@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">{{ __('Budget Type: View') }}</div>

            <div class="card-body">
                <form id="complaint_form" method="post" action="{{ route('budget_types.update', $row->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $row->id }}">
                    <div class="col-lg-12">

                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('label.name') }}</label>
                                <span class="req-star">*</span>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ old('name', $row->title) }}">
                                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('label.sector') }}</label>
                                <span class="req-star">*</span>
                                <input type="text" id="sector" name="sector" class="form-control"
                                       value="{{ old('sector', $row->sector) }}">
                                {!! $errors->first('sector', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">{{ __('label.sub_sector') }}</label>
                                <span class="req-star">*</span>
                                <input type="text" id="sub_sector" name="sub_sector" class="form-control"
                                       value="{{ old('sub_sector', $row->sub_sector) }}">
                                {!! $errors->first('sub_sector', '<p class="text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">{{ __('label.department') }}</label>
                                <span class="req-star">*</span>
                                <select id="department" name="department_idfk" class="form-control">
                                    <?=selectOptions($departments, old('department_idfk', $row->department_idfk))?>
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
                                    onclick="window.open('{{ route('budget_types.index') }}', '_self')">Back
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
@endpush

@push('scripts')
    <script src="{{ asset('assets/cattle/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/cattle/js/additional-methods.min.js')}}"></script>
    <script src="{{ asset('assets/select2/dist/js/select2.full.js') }}"></script>
    <script>

    </script>
@endpush
