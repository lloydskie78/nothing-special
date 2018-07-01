<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Navigation</li>

            <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link {{Route::currentRouteName() == 'dashboard' ? 'active' : ''}}">
                    <i class="icon icon-speedometer"></i> Dashboard
                </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a href="#" class="nav-link nav-dropdown-toggle">
                    <i class="icon icon-options"></i> Products <i class="fa fa-caret-left"></i>
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a href="{{route('dashboardProducts')}}" class="nav-link {{Route::currentRouteName() == 'dashboardProducts' ? 'active' : ''}}">
                            <i class="icon icon-handbag"></i> Products Table
                        </a>
                    </li>
                    <li class="nav-dropdown-items">
                        <a href="{{route('dashboardProductDivision')}}" class="nav-link {{Route::currentRouteName() == 'dashboardProductDivision' ? 'active' : ''}}">
                            <i class="icon icon-list"></i> Product Division
                        </a>
                    </li>
                    <li class="nav-dropdown-items">
                        <a href="{{route('dashboardProductDepartment')}}" class="nav-link {{Route::currentRouteName() == 'dashboardProductDepartment' ? 'active' : ''}}">
                            <i class="icon icon-list"></i> Product Department
                        </a>
                    </li>
                    <li class="nav-dropdown-items">
                        <a href="{{route('dashboardProductDepartmentSub')}}" class="nav-link {{Route::currentRouteName() == 'dashboardProductDepartmentSub' ? 'active' : ''}}">
                            <i class="icon icon-list"></i> Product Sub Department
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{route('dashboardBrands')}}" class="nav-link {{Route::currentRouteName() == 'dashboardBrands' ? 'active' : ''}}">
                    <i class="icon icon-tag"></i> Brands
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('dashboardPosts')}}" class="nav-link {{Route::currentRouteName() == 'dashboardPosts' ? 'active' : ''}}">
                    <i class="icon icon-event"></i> News
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('dashboardBranches')}}" class="nav-link {{Route::currentRouteName() == 'dashboardBranches' ? 'active' : ''}}">
                    <i class="icon icon-globe"></i> Branches
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('dashboardCareers')}}" class="nav-link {{Route::currentRouteName() == 'dashboardCareers' ? 'active' : ''}}">
                    <i class="icon icon-people"></i> Careers
                </a>
            </li>



        </ul>
    </nav>
</div>