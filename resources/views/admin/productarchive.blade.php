@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            Products Archive
        </h2>

        <div class="mb-2">
            <button data-btn='product_restore' type="button" class="btn btn-success btn-sm btn_restore">Restore Product/s</button>
            <button data-btn="btn_harddelete" type="button" class="btn btn-danger btn-sm btn_harddelete" >Remove Product/'s</button>
        </div>
        <table class='table table-bordered table-hover display table-sm' id='productsarchive_table'>
            <thead>
            <tr>
                <td style="width: 1%">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <th>Barcode</th>
                <th>Item Name</th>
                <th>Brand</th>
                <th>Division</th>
                <th>Department</th>
                <th>Availability</th>
                <th>Image</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>
@endsection

@push('scripts')
    <script>
        $(function () {
            var product_table = $('#productsarchive_table').DataTable({
                select: false,
                ordering: true,
                order: [7, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'productsarchive']) !!}',
                columns: [
                    {
                        data: 'idProduct', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">'
                        }
                    },
                    {data: 'barcode'},
                    {data: 'prodName'},
                    {data: 'brandName'},
                    {data: 'parent'},
                    {data: 'subParent'},
                    {
                        data: 'availability', render: function (data) {
                            return (data == 0 ? "Not Available" : "Available");
                        }
                    },

                    {
                        data: 'imageFile', render: function (data) {
                            return '<img src="../assets/img/products/' + data + '" class="img-fluid">';
                        }
                    },
                    {data:'details',visible:false}
                ], "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }]
            });
        });
    </script>
@endpush