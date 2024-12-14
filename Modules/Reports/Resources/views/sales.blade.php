@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="search-form" method="post">
                    @csrf
                    @include('reports::sales.filters')
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><span class="pull-left">{{ __($title) }}</span>
                <span style="float: right;">
                        <a href="{{ route('budget_types.create') }}" class="btn btn-success btn-sm">Create</a></span>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    <table id="order-listing" class="table align-middle  mb-0 users-tbl" >
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">Sr #</th>
                            <th scope="col" class="border-0">Ref. Number</th>
                            <th scope="col" class="border-0">Amount</th>
                            <th scope="col" class="border-0">Login User</th>
{{--                            <th scope="col" class="border-0">Branch</th>--}}
                            <th scope="col" class="border-0">Date</th>
                            <th scope="col" class="border-0">Action</th>
                        </tr>
                        </thead>
                        <!-- Table body START -->
                        <tbody>
                        @if (!blank($rows))
                            @foreach($rows as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row['reference_number'] }}</td>
                                    <td>{{ $row['total_amount'] }}</td>
                                    <td>{{ $row['user_id'] ? $row->creator->name : '--' }}</td>
                                    <td>{{ $row['created_date'] }}</td>
                                    <td>
                                        <a href="{{ route('order.show',[$row->order_id]) }}" class=""><i
                                                class='bx bx-edit fa fa-eye'></i></a>|
{{--                                        <a href="{{ route('budget_types.edit',[$row->inventory_id]) }}" class=""><i--}}
{{--                                                class='bx bx-pencil fa fa-pencil'></i></a>|--}}
{{--                                        <a href="javascript:void(0);"--}}
{{--                                           onclick='verifyCheck("{{ route('budget_types.destroy',[$row->inventory_id]) }}")'--}}
{{--                                           class=""><i class='bx bx-trash fa fa-trash'></i></a>--}}
                                    </td>
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

            $('#order-listing1').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                async:false,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },

                ajax: {
                    url:"{{ route('sales.datatable') }}",
                    type:'POST',
                    data: function (d) {
                        d._token = "<?php echo csrf_token(); ?>";
                        d.user_id = $('#user_id').val();
                        d.reference_number = $('#reference_number').val();
                        d.search_date = $('#search_date').val();
                        // d.status=1;
                    }
                },
                columns: [
                    { data: 'order_id', name: 'order_id' ,"visible": false},
                    { data: 'reference_number', name: 'reference_number', className: "text-center","orderable": false},
                    { data: 'total_amount', name: 'total_amount' ,"orderable": true},
                    // { data: 'login_user', name: 'login_user' ,"orderable": false},
                    // { data: 'branch_name', name: 'branch_name' ,className: "text-center","orderable": false},
                    { data: 'created_date', name: 'created_date' ,"orderable": true},
                    { data: 'action', name: 'action' ,"orderable": false}
                ],
                "order": [[ 1, "asc" ]],
            });
        });


        function search_data() {
            table = $('#order-listing').DataTable();
            table.draw();
        }

        function clear_search_data() {
            $("#form")[0].reset();
            $('#search_date').val(null).trigger('change');
            $('#reference_number').empty();
            $('#user_id').empty();

            // $('.chosen-select').trigger("chosen:updated");
            // $('.search-filters').find('input:text').val('');
            search_data();
        }
    </script>
@endpush

