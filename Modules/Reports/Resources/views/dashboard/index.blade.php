@extends('layouts.app')

@section('content')
    <div class="row">
        @foreach($formsStats as $stats)
        <div class="col-sm-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <a href="{{ $stats['route_url'] }}"><i class="mdi mdi-plus-box-multiple widget-icon
                        bg-success-lighten text-success"></i></a>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="">{{ $stats['node_name'] }}</h5>
                    <h3 class="mt-3 mb-3">{{ $stats['total'] }}</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-nowrap">Created by: </span> {{ $stats['creator'] }}
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        @endforeach
        <div class="col-sm-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-end">
                        <i class="mdi mdi-cart-plus widget-icon bg-success-lighten text-success"></i>
                    </div>
                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Orders</h5>
                    <h3 class="mt-3 mb-3">5,543</h3>
                    <p class="mb-0 text-muted">
                        <span class="text-danger me-2"><i class="mdi mdi-arrow-down-bold"></i> 1.08%</span>
                        <span class="text-nowrap">Since last month</span>
                    </p>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <div class="col-md-12 d-none">
        <div class="card">
            <div class="card-header"><span class="pull-left">{{ __($title) }}</span>
                <span style="float: right;display: none;">
                        <a href="{{ route('budget_types.create') }}" class="btn btn-success btn-sm">Create</a></span>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-12">

                </div>
            </div>
        </div>

    </div>
@endsection

@push('style')

@endpush

@push('scripts')
    <script>
        $(document).ready(function () {


        });
    </script>
@endpush

