@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header"><span class="pull-left">{{ __('Users') }}</span>
                        <span style="float: right;">
                        <a href="{{ route('acl.user.create') }}" class="btn btn-success btn-sm">Create</a></span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="col-lg-12">
                                <table class="table align-middle p-4 mb-0 users-tbl">
                                    <!-- Table head -->
                                    <thead>
                                    <tr>
                                        <th scope="col" class="border-0">Sr #</th>
                                        <th scope="col" class="border-0">Name</th>
                                        <th scope="col" class="border-0">Email</th>
                                        <th scope="col" class="border-0">Department</th>
                                        <th scope="col" class="border-0">Status</th>
                                        <th scope="col" class="border-0">Action</th>
                                    </tr>
                                    </thead>
                                    <!-- Table body START -->
                                    <tbody>
                                    @if (!blank($rows))
                                        @foreach($rows as $index => $row)
                                            @php
                                                $bgColor = 'bg-warning';
                                                if ($row->case_status == 'completed') {
                                                    $bgColor = 'bg-success';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $row['name'] }}</td>
                                                <td>{{ $row['email'] }}</td>
                                                <td class="text-capitalize">{{ !is_null($row['department']) ? $row['department']['name'] : '--' }}</td>
                                                <td>
                                                    <span class="badge {{ $bgColor }} text-capitalize">{{ $row['status'] }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('acl.user.show',[$row->id]) }}" class=""><i class="far fa-fw fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-dark text-center h-100px"> No User Found! </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <!-- Table body END -->
                                </table>

                            </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection

@push('style')

@endpush

@push('scripts')
    <script >
        $('.users-tbl').DataTable();
    </script>
@endpush
