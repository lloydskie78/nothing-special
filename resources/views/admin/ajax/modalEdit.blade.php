@switch($form_id)
@case('brand_edit')
{{Form::model($data,['method'=>'POST','class' => 'modal_form','id' => 'brand_form','files' => true])}}
{{Form::hidden('form_id','brand_edit')}}
{{Form::hidden('idToBeUpdated',$data->idBrand)}}
{{--<div class="form-group">--}}
{{--{{Form::label('Id')}}--}}
{{--{{Form::text('idBrand',null,['class' => 'form-control','placeholder' => 'Brand Id','required'])}}--}}
{{--</div>--}}
<div class="form-group">
    {{Form::label('Name')}}
    {{Form::text('brandName',null,['class' => 'form-control','placeholder' => 'Brand Name','required'])}}
</div>
<div class="form-group">
    <div class="container-fluid col-5">
        <img src="{{asset('assets/img/brands/'.$data->imageFile)}}" class="img-fluid">
    </div>
    {{-- {{Form::file('imageFile',null,['class' => 'form-control-file form_image','accept'=>'image/*'])}} --}}
    <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
</div>

<div class="form-group">
    {{Form::label('Status')}}
    {{Form::select('status', [0 => 'Inactive', 1 => 'Active'], null,['class' => 'custom-select custom-select-sm'])}}
</div>
{{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
{{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
{!! Form::close() !!}
@break

@case('product_edit')
<div class="row">
    <div class="container-fluid col-6">
        {{ Form::model($data, ['class' => 'modal_form', 'id' => 'product_form', 'files' => true]) }}
        {{ Form::hidden('form_id', 'product_edit') }}
        {{ Form::hidden('idToBeUpdated', $data->idProduct) }}
        <div class="form-group">
            {{ Form::label('Barcode') }}
            {{ Form::text('barcode', null, ['class' => 'form-control', 'placeholder' => '#######', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Name') }}
            {{ Form::text('prodName', null, ['class' => 'form-control', 'placeholder' => 'Product Name', 'required']) }}
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                {{ Form::label('Brand') }}
                {{ Form::select('idBrand', $select_brands, $data->idBrand, ['class' => 'custom-select custom-select-sm']) }}

            </div>
            <div class="form-group col-md-4">
                {{ Form::label('Division') }}
                {{ Form::select('idParent', $select_divisions, null, ['class' => 'custom-select custom-select-sm', 'id' => 'divisionSelect']) }}
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('Department') }}
                {{ Form::select('idSub', $select_departments, null, ['class' => 'custom-select custom-select-sm', 'id' => 'deptSelect']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('Sub Department') }}
            {{ Form::select('idDepartmentSub', $select_subDepartments, null, ['class' => 'custom-select custom-select-sm', 'id' => 'subdeptSelect']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Details') }}
            {{ Form::textarea('details', $data->details, ['class' => 'form-control textarea-no-styles', 'rows' => 3]) }}
        </div>
        <div class="form-row mb-2">
            <div class="col-6">
                <h7>Product Image: </h7>
                {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
                --}}
                <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
            </div>
            <div class="col-6">
                <h7>Featured Image: </h7>
                {{-- {{ Form::file('feaImageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
                --}}
                <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-4">
                {{ Form::label('Featured') }}
                {{ Form::select('isfeatured', [0 => 'Not Featured', 1 => 'Featured'], null, ['class' => 'custom-select custom-select-sm']) }}
            </div>
            <div class="form-group col-4">
                {{ Form::label('Availability') }}
                {{ Form::select('availability', [0 => 'Not Available', 1 => 'Available'], null, ['class' => 'custom-select custom-select-sm']) }}
            </div>
            <div class="form-group col-4">
                {{ Form::label('Def. Product Page') }}
                {{ Form::select('showProduct', [0 => 'Hide', 1 => 'Show'], null, ['class' => 'custom-select custom-select-sm']) }}
            </div>
        </div>
        {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {!! Form::close() !!}
    </div>
    <div class="container-fluid col-6">
        <h3>Image Preview: </h3>
        <img src="{{ asset('assets/img/products/' . $data->imageFile) }}" class="img-fluid">
        <h3>Featured Image Peview: </h3>
        <img src="{{ asset('assets/img/products/featuredImage/' . $data->feaImageFile) }}" class="img-fluid">
    </div>
</div>

<!-- {{ dd(get_defined_vars()['__data']) }} -->
@break

@case('news_edit')
{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'brand_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'news_edit') }}
{{ Form::hidden('idToBeUpdated', $data->idNews) }}
<div class="form-group">
    <div class="container-fluid col-5">
        <img src="{{ asset('assets/img/news/' . $data->imageFile) }}" class="img-fluid">
    </div>
    {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }} --}}
    <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
</div>
<div class="form-group">
    {{ Form::label('Post Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Brand Name', 'required']) }}
</div>
<div class="form-group">
    {{ Form::label('Post Content') }}
    {{ Form::textarea('content', null, ['class' => 'form-control', 'rows' => 3]) }}
</div>
<div class="form-group">
    {{ Form::label('Status') }}
    {{ Form::select('status', ['I' => 'Inactive', 'A' => 'Active'], null, ['class' => 'custom-select custom-select-sm']) }}
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}
@break

@case('career_edit')

{{-- {!! $data !!} --}}

{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'career_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'career_edit') }}
{{ Form::hidden('idToBeUpdated', $data->idJob) }}
{{ Form::hidden('branchId', $data->branchId, ['class' => 'form-control', 'id' => 'txtBranchId']) }}

<div class="form-group">
    {{ Form::label('Job Title') }}
    {{ Form::text('jobTitle', null, ['class' => 'form-control', 'placeholder' => 'Job Title', 'required']) }}
</div>

<div class="form-group">
    {{ Form::label('Luzon', null, ['id' => 'lblluzon']) }}
    {{ Form::select('luzBranchEdit[]', $select_branch_luzon, explode(', ', $data->branchId), ['id' => 'luzonBranchEdit', 'multiple' => 'multiple', 'name' => 'luzBranchEdit[]']) }}
    <input type="hidden" name="luzon" class="form-control" id="txtLuzon" value="{{ $data->luzon }}">
</div>

<div class="form-group">
    {{ Form::label('Visayas', null, ['id' => 'lblvisayas']) }}
    {{ Form::select('visBranchEdit[]', $select_branch_visayas, explode(', ', $data->branchId), ['id' => 'visayasBranchEdit', 'multiple' => 'multiple', 'name' => 'visBranchEdit[]']) }}
    <input type="hidden" name="visayas" class="form-control" id="txtVisayas" value="{{ $data->visayas }}">
</div>

<div class="form-group">
    {{ Form::label('Mindanao', null, ['id' => 'lblmindanao']) }}
    {{ Form::select('minBranchEdit[]', $select_branch_mindanao, explode(', ', $data->branchId), ['id' => 'mindanaoBranchEdit', 'multiple' => 'multiple', 'name' => 'minBranchEdit[]']) }}
    <input type="hidden" name="mindanao" class="form-control" id="txtMindanao" value="{{ $data->mindanao }}">
</div>

<div class="form-group">
    {{ Form::label('Job Description') }}
    <div class="description border" contentEditable="true">
        {!! $data->desc !!}
    </div>
    {{ Form::textarea('desc', null, ['class' => 'form-control careerDesc', 'placeholder' => 'Description', 'required', 'rows' => 3, 'hidden']) }}
</div>
<div class="form-row">
    <div class="form-group col-6">
        {{ Form::label('Job Category') }}
        {{ Form::select('catID', $select_jobcat, null, ['class' => 'custom-select custom-select', 'required']) }}
    </div>
    <div class="form-group col-6">
        {{ Form::label('Order') }}
        {{ Form::text('dbstat', null, ['class' => 'form-control', 'placeholder' => 'Input Order', 'required']) }}
    </div>
</div>

<div class="form-group">
    {{ Form::label('Status') }}
    {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}
@break

@case('branch_edit')
{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'brand_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'branch_edit') }}
{{ Form::hidden('idToBeUpdated', $data->idBranch) }}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('Name') }}
            {{ Form::text('branchName', null, ['class' => 'form-control', 'placeholder' => 'Branch Name', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Code') }}
            {{ Form::text('branchCode', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
        </div>
        <div class="form-group">
            {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
            --}}
            <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
        </div>
        <div class="row">
            <div class="form-group col-6">
                {{ Form::label('Island') }}
                {{ Form::select('islandGroup', [3 => 'Mindanao', 2 => 'Visayas', 1 => 'Luzon'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
            </div>
            <div class="form-group col-6">
                {{ Form::label('Status') }}
                {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
            </div>
            <div class="form-group col-6">
                {{ Form::label('X:') }}
                {{ Form::text('tooltipx', null, ['class' => 'form-control', 'placeholder' => 'Tooltip X', 'required']) }}
            </div>

            <div class="form-group col-6">
                {{ Form::label('Y:') }}
                {{ Form::text('tooltipy', null, ['class' => 'form-control', 'placeholder' => 'Tooltip Y', 'required']) }}
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="container-fluid col-12">
            <img src="{{ asset('assets/img/branch/' . $data->imageFile) }}" class="img-fluid">
        </div>
        <div class="row">
            <div class="form-group col-6">
                {{ Form::label('Telephone') }}
                {{ Form::text('telno', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
            </div>
            <div class="form-group col-6">
                {{ Form::label('Fax') }}
                {{ Form::text('faxno', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('Address') }}
            {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => 1]) }}
        </div>
        <div class="form-group">
            {{ Form::label('Store Hours') }}
            {{ Form::textarea('storeHours', null, ['class' => 'form-control', 'rows' => 1]) }}
        </div>
        <div class="form-group">
            {{ Form::label('Latitude and Longitude') }}
            {{ Form::text('latlng', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
        </div>
    </div>


</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{!! Form::close() !!}
@break

@case('division_edit')
{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'division_form']) }}
{{ Form::hidden('form_id', 'division_edit') }}
{{ Form::hidden('idToBeUpdated', $data->idDivision) }}
<div class="form-group">
    {{ Form::label('EBS ID') }}
    {{ Form::text('EBSid', null, ['class' => 'form-control', 'placeholder' => 'Branch Name', 'required', 'disabled']) }}
</div>
<div class="form-group">
    {{ Form::label('Division Name') }}
    {{ Form::text('Division', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
</div>
<div class="form-group">
    {{ Form::label('Status') }}
    {{ Form::select('division_status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{!! Form::close() !!}
@break
@case('department_edit')
{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'department_form']) }}
{{ Form::hidden('form_id', 'department_edit') }}
{{ Form::hidden('idToBeUpdated', $data->idDepartment) }}
<div class="form-group">
    {{ Form::label('EBS ID') }}
    {{ Form::text('EBSid', null, ['class' => 'form-control', 'placeholder' => 'Branch Name', 'required', 'disabled']) }}
</div>
<div class="form-group">
    {{ Form::label('Department Name') }}
    {{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
</div>
<div class="form-row">
    <div class="form-group col-6">
        {{ Form::label('Division') }}
        {{ Form::select('idDivision', $select_division, null, ['class' => 'custom-select custom-select-sm', 'required']) }}
    </div>
    <div class="form-group col-6">
        {{ Form::label('Status') }}
        {{ Form::select('department_status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
    </div>
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{!! Form::close() !!}
@break
@case('brand_edit')
{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'brand_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'brand_edit') }}
{{ Form::hidden('idToBeUpdated', $data->idBrand) }}
{{--<div class="form-group">--}}
{{--{{ Form::label('Id') }}--}}
{{--{{ Form::text('idBrand', null, ['class' => 'form-control', 'placeholder' => 'Brand Id', 'required']) }}--}}
{{--</div>--}}
<div class="form-group">
    {{ Form::label('Name') }}
    {{ Form::text('brandName', null, ['class' => 'form-control', 'placeholder' => 'Brand Name', 'required']) }}
</div>
<div class="form-group">
    <div class="container-fluid col-5">
        <img src="{{ asset('assets/img/brands/' . $data->imageFile) }}" class="img-fluid">
    </div>
    {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }} --}}
    <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
</div>
<div class="form-group">
    {{ Form::label('Status') }}
    {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm']) }}
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{!! Form::close() !!}
@break


@case('banner_edit')

{{ Form::model($data, ['method' => 'POST', 'class' => 'modal_form', 'id' => 'banner_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'banner_edit') }}
{{ Form::hidden('page', $data->pagename) }}

{{ Form::hidden('idToBeUpdated', $data->bannerid) }}
<div class="form-group">
    {{ Form::label('Module Name') }}
    {{ Form::text('pagename', null, ['class' => 'form-control', 'placeholder' => 'Name', 'readonly']) }}
</div>

<div class="form-row">
    @if ($data->pagename == 'Home')
    {{ Form::label('Page Video') }}
    <div style='height:100%; width:100%;' class="form-group">
        <video style='display: block; margin-left: auto; margin-right: auto;' width="700" height="100%" muted
            loop="true" autoplay="autoplay" id="bgvid">
            <source type="video/mp4" src="{{ asset('assets/img/banner/' . $data->pagevideo) }}">
        </video>
    </div>
    {{ Form::file('pagevideo', null, ['class' => 'form-control-file form_image']) }}
    <div style='height:100%; width:100%;' class="form-group">
        {{ Form::label('Banner Image') }}
        <img style='display: block; margin-left: auto; margin-right: auto;' height="300px" width="700px"
            src="{{ asset('assets/img/banner/' . $data->bannerimage) }}?={{ filemtime('assets/img/banner/' . $data->bannerimage) }}">
    </div>
    {{ Form::file('bannerimage', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
    @else
    {{ Form::label('Banner Image') }}
    <div style='height:100%; width:100%;' class="form-group">
        <img style='display: block; margin-left: auto; margin-right: auto;' height="300px" width="700px"
            src="{{ asset('assets/img/banner/' . $data->bannerimage) }}?={{ filemtime('assets/img/banner/' . $data->bannerimage) }}">
    </div>
    {{ Form::file('bannerimage', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
    @endif
</div>
<br>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{!! Form::close() !!}
@break
@case('link_edit')

<div class="row">

    <div class="container-fluid col-6">
        {{ Form::model($data, ['class' => 'modal_form', 'id' => 'link_form', 'files' => true]) }}
        {{ Form::hidden('form_id', 'link_edit') }}
        {{ Form::hidden('idToBeUpdated', $data->id) }}
        <div class="form-group">
            {{ Form::label('Name') }}
            {{ Form::text('name', null, ['class' => 'form-control textarea-no-styles', 'rows' => 3]) }}
        </div>

        <div class="form-group">
            {{ Form::label('desc') }}
            {{ Form::textarea('desc', null, ['class' => 'form-control textarea-no-styles', 'rows' => 3]) }}
        </div>

        <div class="form-row mb-2">
            <div class="col-6">
                <h7>Image Recommended Size: 220x187</h7>
                {{-- {{ Form::file('image', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
                --}}
                <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-4">
                {{ Form::label('Status') }}
                {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm']) }}
            </div>
        </div>

        {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        {{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
        {!! Form::close() !!}

    </div>
    <div class="container-fluid col-6">
        <h3>Image Preview: </h3>
        <img src="{{ asset('assets/img/featured/' . $data->image) }}" class="img-fluid">
    </div>
</div>

@break

@default
<span>Something went wrong, please try again</span>
@endswitch



<!-- center the img to div -->
<!-- style = 'display: block; margin-left: auto; margin-right: auto; ' -->
<!-- attach border -->
<!-- border-style: solid; -->