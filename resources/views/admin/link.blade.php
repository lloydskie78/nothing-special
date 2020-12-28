@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            Featured
        </h2>

        <div class="mb-2">
            
            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="link_edit" data-modal="edit">Set Link</button>
           
        </div>
        <table class='table table-bordered table-hover display table-sm' id='link_table'>
            <thead>
            <tr>
                <td>
                <!--     <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                        <label class="form-check-label" for="checkAll"></label>
                    </div> -->
                </td>
                <td>Name</td>
                <td>Description</td>
                <td>Image</td>
                <td>Status</td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


    </div>
@endsection
@push('scripts')imgholder
    <script>
        $(function () {
            var link_table = $('#link_table').DataTable({
                select: false,
                ordering: true,
                order: [3, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!! route('ajaxData',['table' => 'link']) !!}',
                columns: [
                    {
                        data: 'id', render: function (data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' + data + '">';
                        }
                    },
                    {data: 'name'},
                    {data: 'desc'},
                    {data: 'image'},
                    {data: 'status', render: function (data) {
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


@section('styles')
    <style>
      .modal-dialog { 
          width: 350px; 
          height:350px;
      }
    </style>
@stop