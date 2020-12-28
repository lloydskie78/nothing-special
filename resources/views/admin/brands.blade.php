@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container">
        <h2>
            Brands
        </h2>

        <div class="mb-2">
            <button data-btn='brand_add' type="button" class="btn btn-primary btn-sm" data-modal="add"
                    data-toggle="modal"
                    data-target="#myModal">Add Brand
            </button>
            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="brand_edit" data-modal="edit">Edit Brand/'s</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" >Delete Brand/'s</button>
        </div>
        <table class='table table-bordered table-hover display table-sm' id='brand_table'>
            <thead>
            <tr>
                <td style="width: 1%">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <th style="width: 22.5%">Id</th>
                <th style="width: 22.5%">Name</th>
                <th style="width: 22.5%">Status</th>
                <th style="width: 22.5%">Image</th>
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
            var brands_table = $('#brand_table').DataTable({
                select: false,
                ordering: true,
                order: [3, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'brands']) !!}',
                columns: [
                    {
                        data: 'idBrand', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">'
                        }
                    },
                    {data: 'idBrand'},
                    {data: 'brandName'},
                    {
                        data: 'status', render: function (data) {
                            return (data == 0 ? "Not Active" : "Active");
                        }
                    },
                    {
                        data: 'imageFile', render: function (data) {
                            if(data === null){
                                return '<img src="../assets/img/defaultimg/' + "na.png"+'" class="img-fluid" >';
                            }
                            else{
                                return '<img src="../assets/img/brands/' + data + '" class="img-fluid" >';
                            }
                        }
                    }
                ], "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }]
            });
        });
    </script>
@endpush