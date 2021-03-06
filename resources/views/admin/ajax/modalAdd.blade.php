@switch($form_id)
@case('brand_add')
{{ Form::open(['method' => 'POST', 'class' => 'modal_form', 'id' => 'brand_form', 'files' => true]) }}
@csrf
{{ Form::hidden('form_id', 'brand_add') }}
{{--<div class="form-group">--}}
{{--{{ Form::label('Id') }}--}}
{{--{{ Form::text('idBrand', null, ['class' => 'form-control', 'placeholder' => 'Brand Id', 'required']) }}--}}
{{--</div>--}}
<div class="form-group">
    {{ Form::label('Name') }}
    {{ Form::text('brandName', null, ['class' => 'form-control', 'placeholder' => 'Brand Name', 'required']) }}
</div>
<div class="form-group">
    {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*', 'id' => 'image_form']) }}
    --}}
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

@case('product_add')
<div class="container-fluid col-12">
    {{Form::open(['class' => 'modal_form','id' => 'product_form','files' => true])}}
    @csrf
    {{ Form::hidden('form_id', 'product_add') }}
    <div class="form-group">
        {{ Form::label('Barcode') }}
        {{ Form::text('barcode', null, ['class' => 'form-control', 'placeholder' => '#######', 'required']) }}
    </div>
    <div class="form-group">
        {{ Form::label('Name') }}
        {{ Form::text('prodName', null, ['class' => 'form-control', 'placeholder' => 'Product Name', 'required']) }}
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            {{ Form::label('Brand') }}
            {{ Form::select('idBrand', ['' => 'Please Select'] + $select_brands, null, ['class' => 'custom-select custom-select-sm', 'required']) }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('Division') }}
            {{ Form::select('idParent', ['' => 'Please Select'] + $select_divisions, null, ['class' => 'custom-select custom-select-sm', 'id' => 'divisionSelect', 'required']) }}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('Department') }}
            {{-- {{ Form::select('idSub', ['' => 'Please Select'] + $select_departments, null, ['class' => 'custom-select custom-select-sm', 'id' => 'deptSelect', 'required']) }}
            --}}
            <select class="custom-select custom-select-sm" id="deptSelect" required name="idSub">
                <option selected="selected">Please Select</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('Sub Department') }}
            {{-- {{ Form::select('idDepartmentSub', ['' => 'Please Select'] + $select_subDepartments, null, ['class' => 'custom-select custom-select-sm', 'id' => 'subdeptSelect', 'required']) }}
            --}}
            <select class="custom-select custom-select-sm" id="subdeptSelect" name="idDepartmentSub">
                <option selected="selected">Please Select</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('Details') }}
        {{ Form::textarea('details', null, ['class' => 'form-control textarea-no-styles', 'rows' => 3], 'required') }}
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <span>Product Image: </span>
            {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*', 'id' => 'image_form']) }}
            --}}
            <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
        </div>
        <div class="form-group col-6">
            <span>Featured Image: </span>
            {{-- {{ Form::file('feaImageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }}
            --}}
            <input type="file" class="form-control-file" id="image_form" accept="image/*" name="feaImageFile">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-4">
            {{ Form::label('Featured') }}
            {{ Form::select('isfeatured', ['' => 'Please Select', 0 => 'Not Featured', 1 => 'Featured'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
        </div>
        <div class="form-group col-4">
            {{ Form::label('Availability') }}
            {{ Form::select('availability', ['' => 'Please Select', 0 => 'Not Available', 1 => 'Available'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
        </div>
        <div class="form-group col-4">
            {{ Form::label('Default Product Page') }}
            {{ Form::select('showProduct', ['' => 'Please Select', 0 => 'Hide', 1 => 'Show'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
        </div>

    </div>
    {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    {{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
    {!! Form::close() !!}
</div>
@break

@case('news_add')
{{ Form::open(['class' => 'modal_form', 'id' => 'news_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'news_add') }}
<div class="form-group">
    {{ Form::label('Post Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Post Title'], 'required') }}
</div>
<div class="form-group">
    {{ Form::label('Post Content') }}
    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Post Title'], 'required') }}
</div>
<div class="form-group">
    {{-- {{ Form::file('imageFile', null, ['class' => 'form-control-file form_image', 'accept' => 'image/*']) }} --}}
    <input type="file" class="form-control-file" id="image_form" accept="image/*" name="imageFile">
</div>
<div class="form-group col-md-3">
    {{ Form::label('Status') }}
    {{ Form::select('status', ['I' => 'Inactive', 'A' => 'Active'], 'I', ['class' => 'custom-select custom-select-sm']) }}
</div>

{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}
@break

@case('career_add')

{{ Form::open(['class' => 'modal_form', 'id' => 'career_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'career_add') }}

<div class="form-group">
    {{ Form::label('Job Title') }}
    {{ Form::text('jobTitle', null, ['class' => 'form-control', 'placeholder' => 'Job Title', 'required']) }}
</div>

<div class="form-group">
    {{ Form::label('Job Category') }}
    {{ Form::select('catID', $select_jobcat, null, ['class' => 'custom-select custom-select-sm', 'required']) }}
</div>

<div class="form-group">
    {{ Form::label('Luzon', null, ['id' => 'lblluzon']) }}
    <select id="luzonBranch" name="luzBranch[]" multiple="multiple">
        @foreach ($luz as $luzon)
        <option value="{{ $luzon->idBranch }}">{{ $luzon->branchName }}</option>
        @endforeach
    </select>
    {{ Form::hidden('luzon', null, ['class' => 'form-control', 'id' => 'txtluzon', 'placeholder' => '']) }}
</div>
</div>

<div class="form-group">
    {{ Form::label('Visayas', null, ['id' => 'lblvisayas']) }}
    <select id="visayasBranch" name="visBranch[]" multiple="multiple">
        @foreach ($vis as $visayas)
        <option value="{{ $visayas->idBranch }}">{{ $visayas->branchName }}</option>
        @endforeach
    </select>
    {{ Form::hidden('visayas', null, ['class' => 'form-control', 'id' => 'txtvisayas', 'placeholder' => '']) }}
</div>

<div class="form-group">
    {{ Form::label('Mindanao', null, ['id' => 'lblmindanao']) }}
    <select id="mindanaoBranch" name="minBranch[]" multiple="multiple">
        @foreach ($min as $mindanao)
        <option value="{{ $mindanao->idBranch }}">{{ $mindanao->branchName }}</option>
        @endforeach
    </select>
    {{ Form::hidden('mindanao', null, ['class' => 'form-control', 'id' => 'txtmindanao', 'placeholder' => '']) }}
</div>

<div class="form-group">
    {{ Form::label('Job Description') }}
    {{ Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => 'Description', 'required', 'rows' => 5]) }}
</div>
<div class="form-group">
    {{ Form::label('Status') }}
    {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'careerSave']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}

@break

@case('branch_add')
{{ Form::open(['class' => 'modal_form', 'id' => 'branch_form', 'files' => true]) }}
{{ Form::hidden('form_id', 'branch_add') }}
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
                {{ Form::select('islandGroup', [1 => 'Luzon', 2 => 'Visayas', 3 => 'Mindanao'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
            </div>
            <div class="form-group col-6">
                {{ Form::label('Status') }}
                {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
            </div>
        </div>
    </div>
    <div class="col-6">
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
            {{ Form::textarea('address', null, ['class' => 'form-control textarea-no-styles', 'rows' => 1]) }}
        </div>
        <div class="form-group">
            {{ Form::label('Store Hours') }}
            {{ Form::textarea('storeHours', null, ['class' => 'form-control textarea-no-styles', 'rows' => 1]) }}
        </div>
        <div class="form-group">
            {{ Form::label('Latitude and Longitude') }}
            {{ Form::text('latlng', null, ['class' => 'form-control', 'placeholder' => 'Branch Code', 'required']) }}
        </div>
    </div>


</div>

{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}
@break

@case('division_add')
{{ Form::open(['class' => 'modal_form', 'id' => 'division_form']) }}
{{ Form::hidden('form_id', 'division_add') }}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('EBS ID') }}
            {{ Form::text('EBSid', null, ['class' => 'form-control', 'placeholder' => 'Id', 'required', 'disabled']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Division Name') }}
            {{ Form::text('Division', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('Status') }}
            {{ Form::select('division_status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
        </div>
    </div>
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}
@break

@case('department_add')
{{ Form::open(['class' => 'modal_form', 'id' => 'department_form']) }}
{{ Form::hidden('form_id', 'department_add') }}
<div class="form-group">
    {{ Form::label('EBS ID') }}
    {{ Form::text('EBSid', null, ['class' => 'form-control', 'placeholder' => 'id', 'required', 'disabled']) }}
</div>
<div class="form-group">
    {{ Form::label('Department Name') }}
    {{ Form::text('Department', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
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
{{ Form::close() }}
@break

@case('subDepartment_add')
{{ Form::open(['class' => 'modal_form', 'id' => 'subDepartment_form']) }}
{{ Form::hidden('form_id', 'subDepartment_add') }}
<div class="form-group">
    {{ Form::label('Category Name') }}
    {{ Form::text('departmentSubName', null, ['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
</div>
<div class="form-row">
    <div class="form-group col-6">
        {{ Form::label('Department') }}
        {{ Form::select('idDepartment', $select_departments, null, ['class' => 'custom-select custom-select-sm', 'required']) }}
    </div>
    <div class="form-group col-6">
        {{ Form::label('Status') }}
        {{ Form::select('status', [0 => 'Inactive', 1 => 'Active'], null, ['class' => 'custom-select custom-select-sm', 'required']) }}
    </div>
</div>
{{ Form::button('Save', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
{{ Form::button('Close', ['type' => 'button', 'class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) }}
{{ Form::close() }}
@break
@default
<span>Something went wrong, please try again</span>
@endswitch