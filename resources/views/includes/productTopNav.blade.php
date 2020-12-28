<div class="product_topNav">
    <div id="productSubDepartmentContainer">
        <label id='lblsearch'>Search by</label>
        <div class="subDepDropDown">
            <button class="dropbtn" id='btnfilter'>Description <i class="fas fa-sort-down"></i></button>
            <div class="dropdown-content" id='btnfilter'>
                <a href='' id='details'>Description</a>
                <a href='' id='brandName'>Brand</a>
                @yield('subDepartmentLink')
            </div>
        </div>
    </div>
    <div id="productSearchContainer">
        <!-- when selecting a link set the hidden field for the department id to load the 
        sub department id -->
        {{ Form::open(['method' => 'GET', 'id' => 'product_search']) }}
        {{ Form::hidden('fieldtofilter', 'details', ['id' => 'txtfilter']) }}
        {{ Form::text('search', Request::input('search'), ['placeholder' => 'Search Product']) }}
        {{ Form::close() }}
        <i class="fas fa-search searchBtn"></i>
    </div>
</div>
