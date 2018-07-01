@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            News
        </h2>

        <div class="mb-2">
            <button data-btn='news_add' type="button" class="btn btn-primary btn-sm" data-modal="add" data-toggle="modal"
                    data-target="#myModal">Add News
            </button>
            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="news_edit" data-modal="edit">Edit News Post/'s</button>
            <button type="button" class="btn btn-danger btn-sm btn_delete" >Delete News Post/'s</button>
        </div>
        <table class='table table-bordered table-hover display table-sm' id='news_table'>
            <thead>
            <tr>
                <td style="width: 1%">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div>
                </td>
                <th>Post Title</th>
                <th>Content</th>
                <th>Date Created</th>
                <th>Status</th>
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
            var news_table = $('#news_table').DataTable({
                select: false,
                ordering: true,
                order: [4, "asc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'news']) !!}',
                columns: [
                    {
                        data: 'idNews', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">'
                        }
                    },
                    {data: 'title'},
                    {data: 'content'},
                    {
                        data: 'date_posted'
                    },
                    {
                        data: 'status', render: function (data) {
                            return (data == 'I' ? "Inactive" : "Active");
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