<div class="product_topNav">
    <div id="productSubDepartmentContainer">
        <label id='lblsearch'>Search by</label>
        <div class="subDepDropDown">
            <button class="dropbtn" id='btnfilter'>Description <i class="fas fa-sort-down"></i></button>
            @if (strpos(Request::path(), 'products/wall-and-floor-tiles') !== false)
            <div class="dropdown-content" id='btnfilter'>
                <a href='' id='details'>Description</a>
                <a href='' id='brandName'>Brand</a>
                @foreach ($wall_and_floor as $item)
                <a href='' id='details'>{{ $item->departmentSubName }}</a>
                @endforeach
                @yield('subDepartmentLink')
            </div>
            @else
            <div class="dropdown-content" id='btnfilter'>
                <a href='' id='details'>Description</a>
                <a href='' id='brandName'>Brand</a>
                @yield('subDepartmentLink')
            </div>
            @endif
        </div>
    </div>
    <div id="productSearchContainer">
        <!-- when selecting a link set the hidden field for the department id to load the 
        sub department id -->
        {{ Form::open(['method' => 'GET', 'id' => 'product_search']) }}
        {{ Form::hidden('fieldtofilter', 'details', ['id' => 'txtfilter']) }}
        {{ Form::hidden('forSearch', null, ['id' => 'forSearch']) }}
        {{ Form::text('search', Request::input('search'), ['placeholder' => 'Search Product', 'id' => 'searchTxt']) }}
        {{ Form::close() }}
        <i class="fas fa-search searchBtn"></i>
    </div>
</div>  