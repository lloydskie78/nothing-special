@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            Branch
        </h2>

        <div class="mb-2">
            <button data-btn='branch_add' type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-modal="add" data-target="#myModal">Add Branch</button>
            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="branch_edit" data-modal="edit">Edit Branch/'s</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" >Delete Branch/'s</button>
        </div>
        <table class='table table-bordered table-hover display table-sm' id='branch_table'>
            <thead>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <td>Branch</td>
                <td>Island Group</td>
                <td>Status</td>
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
            var branch_table = $('#branch_table').DataTable({
                select: false,
                ordering: true,
                order: [3, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'branches']) !!}',
                columns: [
                    {
                        data: 'idBranch', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">';
                        }
                    },
                    {data: 'branchName'},
                    {data: 'islandGroup',render:function (data) {
                         if(data == 1){
                             island = 'Luzon';
                         }else if(data == 2){
                             island = 'Visayas';
                         }else if(data == 3){
                             island = 'Mindanao';
                         }else{
                             island = 'Not Found';
                         }

                         return island;
                        }
                    },
                    {
                        data: 'status', render: function (data) {
                            return (data == 0 ? "Not Active" : "Active");
                        }
                    },
                ], "columnDefs": [{
                    "orderable": false,
                    "targets": 0
                }]
            });
        });
    </script>
@endpush