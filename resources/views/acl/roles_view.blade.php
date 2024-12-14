@extends('layouts.app')

@section('content')
    @include('common.alerts')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><span class="pull-left">{{ __('Roles View') }}</span>
                        <span style="float: right;">
                        {{--                                                <a href="{{ route('acl.user.create') }}" class="btn btn-success btn-sm">Create</a></span>--}}
                    </div>

                    <div class="card-body">
                        <form id="complaint_form" method="post" action="{{ route('acl.role.update',$role->id) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Role {{ __('label.name') }}</label>
                                        <span class="req-star">*</span>
                                        <input type="text" id="name" name="name" class="form-control"
                                               value="{{ old('name', $role->name) }}">
                                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-11">
                                    <div class="form-group p-b-5">
                                        <label for="">{{ __('label.permissions') }}</label>
                                        <span class="req-star">*</span>
                                        {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                        <br/>
                                        @foreach($permissions as $nav => $permission)
                                            <strong>{{ ucwords(str_replace('-',' ',strtolower($nav))) }}</strong>
                                            <br/>
                                            @foreach($permission as $row)
                                                <label style="width: 100px"><input type="checkbox"
                                                                                   id="role-premission-id-{{ $row->id }}"
                                                                                   name="role-permission[]"
                                                                                   value="{{ $row->id }}"
                                                        {{ $role->hasPermissionTo($row->name) ? 'checked' : '' }} />
                                                    {{ str_replace(strtolower($nav).'-', '',$row->name) }}</label>
                                            @endforeach
                                            <hr/>
                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="window.open('{{ route('roles') }}', '_self')">Cancel
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('style')

@endpush

@push('scripts')

@endpush
