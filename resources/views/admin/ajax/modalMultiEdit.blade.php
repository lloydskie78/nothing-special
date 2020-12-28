@switch($form_id)
    @case('brand_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'brand_form','files' => true])}}
    {{Form::hidden('form_id','brand_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
    <div class="form-group">
        {{Form::label('Status')}}
        {{Form::select('status', [0 => 'Inactive', 1 => 'Active'], 0,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
    </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break

    @case('product_edit')
    <div class="row">
        <div class="container-fluid col-12">
            {{Form::open(['class' => 'modal_form multiEdit_form','id' => 'product_form','files' => true])}}
            {{Form::hidden('form_id','product_edit')}}
            {{Form::hidden('idToBeUpdated',$data)}}
            <div class="form-row">
                <div class="form-group col-md-4">
                    {{Form::label('Brand')}}
                    {{Form::select('idBrand', $select_brands, "",['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Brand..'])}}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('Parent')}}
                    {{Form::select('idParent', $select_divisions, "",['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Division..'])}}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('Sub Parent')}}
                    {{Form::select('idSub', $select_departments, "",['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Department..'])}}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('Sub Department')}}
                    {{Form::select('idDepartmentSub', $select_subDepartments, null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Sub Category..'])}}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-4">
                    {{Form::label('Featured')}}
                    {{Form::select('isfeatured', [0 => 'Not Featured', 1 => 'Featured'], "",['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
                </div>
                <div class="form-group col-4">
                    {{Form::label('Availability')}}
                    {{Form::select('availability', [0 => 'Not Available', 1 => 'Available'], "",['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Availability'])}}
                </div>

                <div class="form-group col-4">
                    {{Form::label('Show Product')}}
                    {{Form::select('showProduct', [0 => 'Hide', 1 => 'Show'], null,['class' => 'custom-select custom-select-sm'])}}
                </div>
            </div>
            {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
            {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
            {!! Form::close() !!}
        </div>
    </div>
    @break

    @case('news_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'news_form','files' => true])}}
    {{Form::hidden('form_id','news_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
    <div class="form-group">
        {{Form::label('Status')}}
        {{Form::select('status', ['I' => 'Inactive', 'A' => 'Active'], 0,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
    </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break

    @case('career_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'career_form','files' => true])}}
    {{Form::hidden('form_id','career_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
    <div class="row">
        <div class="form-group col-6">
            {{Form::label('Job Category')}}
            {{Form::select('catID', $select_jobcat, null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Category'])}}
        </div>
        <div class="form-group col-6">
            {{Form::label('Status')}}
            {{Form::select('status', [0 => 'Inactive', 1 => 'Active'], null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
        </div>
    </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break

    @case('branch_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'branch_form','files' => true])}}
    {{Form::hidden('form_id','branch_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
    <div class="row">
        <div class="form-group col-6">
            {{Form::label('Island Group')}}
            {{Form::select('islandGroup', [3 => 'Mindanao', 2 => 'Visayas',1 => 'Luzon'], null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Island'])}}
        </div>
        <div class="form-group col-6">
            {{Form::label('Status')}}
            {{Form::select('status', [0 => 'Inactive', 1 => 'Active'], null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
        </div>
    </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break
    @case('division_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'division_form'])}}
    {{Form::hidden('form_id','division_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
        <div class="form-group">
            {{Form::label('Status')}}
            {{Form::select('division_status', [0 => 'Inactive', 1 => 'Active'], null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
        </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break
    @case('department_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'department_form'])}}
    {{Form::hidden('form_id','department_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
    <div class="row">
        <div class="form-group col-6">
            {{Form::label('Division')}}
            {{Form::select('idDivision', $select_division, null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Division'])}}
        </div>
        <div class="form-group col-6">
            {{Form::label('Status')}}
            {{Form::select('department_status', [0 => 'Inactive', 1 => 'Active'], null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose..'])}}
        </div>
    </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break
    @case('subDepartment_edit')
    {{Form::open(['method'=>'POST','class' => 'modal_form multiEdit_form','id' => 'subDepartment_form'])}}
    {{Form::hidden('form_id','subDepartment_edit')}}
    {{Form::hidden('idToBeUpdated',$data)}}
    <div class="form-row">
        <div class="form-group col-6">
            {{Form::label('Department')}}
            {{Form::select('idDepartment', $select_departments, null,['class' => 'custom-select custom-select-sm','placeholder' => 'Belongs on what department..'])}}
        </div>
        <div class="form-group col-6">
            {{Form::label('Status')}}
            {{Form::select('status', [0 => 'Inctive', 1 => 'Active'], null,['class' => 'custom-select custom-select-sm','placeholder' => 'Choose Status'])}}
        </div>
    </div>
    {{Form::button('Save',['type' => 'submit','class'=>'btn btn-primary'])}}
    {{Form::button('Close',['type' => 'button','class'=>'btn btn-secondary','data-dismiss'=>'modal'])}}
    {!! Form::close() !!}
    @break
    @default
    <span>Something went wrong, please try again</span>
@endswitch


