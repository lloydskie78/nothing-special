@extends('admin.layouts.dashboardMaster')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2">{{$products->count()}}</span>
                            <span class="font-weight-light">Total Products</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-basket"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2">{{$branches->count()}}</span>
                            <span class="font-weight-light">Total Branches</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-pin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2">{{$brands->count()}}</span>
                            <span class="font-weight-light">Total Brands</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-tag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection