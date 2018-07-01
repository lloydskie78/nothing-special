@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            Department
        </h2>

        <div class="mb-2">
            <button data-btn='department_add' type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-modal="add" data-target="#myModal">Add Department</button>
            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="department_edit" data-modal="edit">Edit Department/'s</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" >Delete Department/'s</button>
        </div>
        <table class='table table-bordered table-hover display table-sm' id='department_table'>
            <thead>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <td>Department</td>
                <td>Division</td>
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
            var department_table = $('#department_table').DataTable({
                select: false,
                ordering: true,
                order: [2, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'departments']) !!}',
                columns: [
                    {
                        data: 'idDepartment', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">';
                        }
                    },
                    {data: 'Department'},
                    {data: 'equi_division'},
                    {
                        data: 'department_status', render: function (data) {
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