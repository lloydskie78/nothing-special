<div class="product_topNav">
    <div id="productSubDepartmentContainer">
        <div class="subDepDropDown">
            <button class="dropbtn">Category <i class="fas fa-sort-down"></i></button>
            <div class="dropdown-content">
                @yield('subDepartmentLink')
            </div>
        </div>
    </div>
    <div id="productSearchContainer">
    {{Form::open(['method' => 'GET','id' => 'product_search'])}}
    {{Form::text('search',Request::input('search'),['placeholder' => 'Search Product']) }}
    {{Form::close()}}
        <i class="fas fa-search searchBtn"></i>
    </div>
</div>