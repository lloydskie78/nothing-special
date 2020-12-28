@extends('layouts.master')
@section('content')

    <span id="showSidebar" onclick="openNav();">Categories</span>

    <section class="product_section">
        <div class="col-10">
            <label id="lblproduct">
                <h1 class="header-text m-b-0 mtop">
                    Featured Products
                </h1>
            </label>

            @yield('featured-products')
        </div>
    </section>
    <section class="product_section">
        <div class="col-10">
            <label id='lblproduct'>
                <h1 class="header-text m-b-0 mtop">Products</h1>
            </label>

            <div class="prdctbdy">
                <aside id="mySidenav" class="catlist">
                    @yield('product-cat')
                    <div class="ulcatContainer">
                        <ul class="catContainer">
                            @foreach ($categories as $category)
                                <li class='cat force-select'><a class='frstlvl_cat' href='javascript:void(0);'
                                        data-id='{{ $category->idDivision }}'>{{ $category->Division }}<span>
                                            <i class='fas fa-caret-right'></i></span></a>
                                    <ul class='subcatContainer h-0' data-id='{{ $category->idDivision }}'>
                                        @foreach ($category->subcategories as $subcategory)
                                            @if ($subcategory->products->count() > 0)
                                                <li>
                                                    <a href="{{ route('productPerCat', [
                                                            'category' => str_replace(' ', '-', strtolower($category->Division)),
                                                            'department' => str_replace(' ', '-', strtolower($subcategory->Department)),
                                                        ]) }}" data-id="{{ $subcategory->idDepartment }}"
                                                        id='{{ $category->idDivision }}'
                                                        class='subcat cat{{ $subcategory->idDepartment }}'>{{ $subcategory->Department }}
                                                    </a>
                                                </li>
                                            @endif
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
        if (elmnt) {
            elmnt.scrollIntoView({
                block: 'center',
                behavior: 'instant'
            });
        }

    </script>

@endpush
