@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <h2>
            Banner
        </h2>

        <div class="mb-2">

            <button type="button" class="btn btn-primary btn-sm btn_edit" data-btn="banner_edit" data-modal="edit">Set
                Banner</button>

        </div>
        <table class='table table-bordered table-hover display table-sm' id='banner_table'>
            <thead>
                <tr>
                    <td>
                        <!--     <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                            <label class="form-check-label" for="checkAll"></label>
                        </div> -->
                    </td>
                    <td>Page</td>
                    <td>Banner</td>
                    <td>Video</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>


    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            var banner_table = $('#banner_table').DataTable({
                select: false,
                ordering: true,
                order: [3, "desc"],
                processing: true,
                serverSide: true,
                ajax: '{!!  route('
                ajaxData ', ['
                table ' => '
                banner ']) !!}',
                columns: [{
                        data: 'bannerid',
                        render: function(data) {
                            return '<input type="checkbox" class="btn checkbox_action" name="checked" value="' +
                                data + '">';
                        }
                    },
                    {
                        data: 'pagename'
                    },
                    {
                        data: 'bannerimage'
                    },
                    {
                        data: 'pagevideo'
                    },
                ],
                "columnDefs": [{
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
            height: 350px;
        }

    </style>
@stop
