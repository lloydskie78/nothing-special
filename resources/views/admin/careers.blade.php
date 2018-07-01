@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            Career
        </h2>

        <div class="mb-2">
            <button data-btn='career_add' type="button" class="btn btn-primary btn-sm" data-modal="add" data-toggle="modal" data-target="#myModal">Add Career</button>
            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="career_edit" data-modal="edit">Edit Career/'s</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" >Delete Career/'s</button>
        </div>
        <table class='table table-bordered table-hover display table-sm' id='career_table'>
            <thead>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <td>Job</td>
                <td>Category</td>
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
            var career_table = $('#career_table').DataTable({
                select: false,
                ordering: true,
                order: [3, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'careers']) !!}',
                columns: [
                    {
                        data: 'idJob', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">';
                        }
                    },
                    {data: 'jobTitle'},
                    {data: 'job_category'},
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