@extends('layouts.master')
@section('content')

    <span id="showSidebar" onclick="openNav();">Categories</span>

    <section class="product_section">
        <div class="col-10">
            <h1 class="header-text m-b-0 mtop">Products</h1>

            <div class="prdctbdy">
                <aside id="mySidenav" class="catlist">
                    @yield('product-cat')
                    <div class="ulcatContainer">
                        <ul class="catContainer">



                            @foreach ($categories as $category)
                            <li class='cat force-select'><a class='frstlvl_cat' href='javascript:void(0);' data-id='{{$category->idDivision}}'>{{$category->Division}}<span>
												<i class='fas fa-caret-right'></i></span></a>
                                <ul class='subcatContainer h-0' data-id='{{$category->idDivision}}'>
                                    @foreach ($category->subcategories as $subcategory)
                                    <li><a href="{{route('productPerCat',$subcategory->idDepartment)}}" data-id="{{$subcategory->idDepartment}}" class='subcat cat{{$subcategory->idDepartment}}'>{{$subcategory->Department}}</a></li>
                                    @endforeach
                                    </ul>
                             </li>
                            @endforeach



                        </ul>
                    </div>
                </aside>
                <div class="product-container">
                        @yield('product-content')
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>

        var elmnt = document.getElementsByClassName('productClass')[0];
        if(elmnt)
        {
            elmnt.scrollIntoView({ block: 'center',  behavior: 'instant' });
        }

    </script>

@endpush