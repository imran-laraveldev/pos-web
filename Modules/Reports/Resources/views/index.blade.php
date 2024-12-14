@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form id="search-form" method="post">
                    @csrf
                    @include('reports::filters')
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
                <div class="col-md-12">
                    <table class="table align-middle p-4 mb-0 users-tbl">
                        <!-- Table head -->
                        <thead>
                        <tr>
                            <th scope="col" class="border-0">Sr #</th>
                            <th scope="col" class="border-0">Category</th>
                            <th scope="col" class="border-0">Color</th>
                            <th scope="col" class="border-0">Code</th>
                            <th scope="col" class="border-0">Name</th>
                            <th scope="col" class="border-0">Quantity</th>
                            <th scope="col" class="border-0">Sale Price</th>
                            <th scope="col" class="border-0">Vendor</th>
                            <th scope="col" class="border-0">Status</th>
                            <th scope="col" class="border-0">Action</th>
                        </tr>
                        </thead>
                        <!-- Table body START -->
                        <tbody>
                        @if (!blank($rows))
                            @foreach($rows as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row['name'] }}</td>
                                    <td class="text-capitalize">{{ !is_null($row['name_ar']) ? $row['name_ar'] : '--' }}</td>
                                    <td>{{ $row['description'] }}</td>
                                    <td>{{ $row['sale_price'] }}</td>
                                    <td>{{ $row['quantity'] }}</td>
                                    <td>
                                        <a href="{{ route('budget_types.show',[$row->inventory_id]) }}" class=""><i
                                                class='bx bx-edit fa fa-eye'></i></a>|
                                        <a href="{{ route('budget_types.edit',[$row->inventory_id]) }}" class=""><i
                                                class='bx bx-pencil fa fa-pencil'></i></a>|
                                        <a href="javascript:void(0);"
                                           onclick='verifyCheck("{{ route('budget_types.destroy',[$row->inventory_id]) }}")'
                                           class=""><i class='bx bx-trash fa fa-trash'></i></a>
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

            $('.users-tbl').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                async:false,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },

                ajax: {
                    url:"{{ route('inventory.datatable') }}",
                    type:'POST',
                    data: function (d) {
                        d._token = "<?php echo csrf_token(); ?>";
                        d.name = $('#name').val();
                        d.vendor = $('#vendor').val();
                        d.department = $('#department').val();
                        // d.status=1;
                    }
                },
                columns: [
                    { data: 'inventory_id', name: 'inventory_id' ,"visible": false},
                    { data: 'department_name', name: 'department_id', className: "text-center","orderable": false},
                    { data: 'color_box', name: 'color_box' ,"orderable": true},
                    { data: 'code', name: 'barcode' ,"orderable": true},
                    { data: 'inventory_name', name: 'name' ,"orderable": true},
                    { data: 'quantity', name: 'quantity' ,className: "text-center","orderable": false},
                    { data: 'sale_price', name: 'sale_price' ,"orderable": false},
                    { data: 'vendor_name', name: 'vendor_id', "orderable": false},
                    { data: 'display_screen', name: 'display_screen' ,"orderable": false},
                    { data: 'action', name: 'action' ,"orderable": false}
                ],
                "order": [[ 1, "asc" ]],
            });
        });


        function search_data() {
            table = $('#complaint-listing').DataTable();
            table.draw();
        }

        function clear_search_data() {
            $("#form")[0].reset();
            $('#division_id').val(null).trigger('change');
            $('#district_id').empty();
            $('#tehsil_id').empty();

            // $('.chosen-select').trigger("chosen:updated");
            $('.search-filters').find('input:text').val('');
            search_data();
        }
    </script>
@endpush

