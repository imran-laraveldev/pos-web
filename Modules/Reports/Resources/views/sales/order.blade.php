@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label class="label" >Ref Number: </label> {{ $item->reference_number }}
                    </div>
                    <div class="col-md-4">
                        <label class="label" >Date: </label> {{ $item->created_date }}
                    </div>

                    <div class="col-md-4">
                        <label class="label" >Amount: </label> {{ $item->total_amount }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><span class="pull-left">Order Detail</span>
                <span style="float: right;">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm">Print</a></span>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-12">
                    <table class="table align-middle p-4 mb-0 users-tbl">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">Sr #</th>
                            <th scope="col" class="border-0">Code</th>
                            <th scope="col" class="border-0">Name</th>
                            <th scope="col" class="border-0">Quantity</th>
                            <th scope="col" class="border-0">Unit Price</th>
                            <th scope="col" class="border-0">Price</th>
                        </tr>
                        </thead>
                        <!-- Table body START -->
                        <tbody>
                        @if (!blank($item))
                            @foreach($item->order_details as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->inventory->barcode }}</td>
                                    <td>{{ $row->inventory->name }}</td>
                                    <td>{{ $row['quantity'] }}</td>
                                    <td>{{ $row['unit_price'] }}</td>
                                    <td>{{ $row['quantity']*$row['unit_price'] }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-dark text-center h-100px"> No Record Found!</td>
                            </tr>
                        @endif
                        </tbody>
                        <!-- Table body END -->
                    </table>

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

            $('.users-tbl').DataTable();
        });



    </script>
@endpush

