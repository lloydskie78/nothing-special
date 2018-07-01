<?php

namespace App\Providers;

use App\Brand;
use App\Department;
use App\Division;
use App\JobCategory;
use App\SubDepartment;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('vendor.pagination.bootstrap-4');
        Schema::defaultStringLength(191);

        $luz = DB::table('ctbranches')->where('islandGroup',1)->orderBy('branchName', 'asc')->get();
        $vis = DB::table('ctbranches')->where('islandGroup',2)->orderBy('branchName', 'asc')->get();
        $min = DB::table('ctbranches')->where('islandGroup',3)->orderBy('branchName', 'asc')->get();
        $branches = DB::table('ctbranches')->orderBy('branchName', 'asc')->get();


        $categories = Division::where('division_status', 1)->orderBy('Division', 'asc')->with('subcategories')->get();
        $brands = Brand::all();

        $select_divisions = selectArray(Division::DivisionAscending()->get(),'Division','idDivision');
        $select_departments = selectArray(Department::DepartmentAscending()->get(),'Department','idDepartment');
        $select_subDepartments = selectArray(SubDepartment::DepartmentSubNameAscending()->get(),'departmentSubName','id');
        $select_brands = selectArray(Brand::BrandAscending()->get(),'brandName','idBrand');
        $select_jobcat = selectArray(JobCategory::JobCatAscending()->get(),'name','id');
        $select_division = selectArray(Division::DivisionAscending()->get(),'Division','idDivision');


        View::share([
            'luz' => $luz,
            'vis' => $vis,
            'min' => $min,
            'branches' => $branches,
            'categories' => $categories,
            'select_divisions' => $select_divisions,
            'select_departments' => $select_departments,
            'select_subDepartments' => $select_subDepartments,
            'select_brands' => $select_brands,
            'select_jobcat' => $select_jobcat,
            'select_division' => $select_division,
            'brands' => $brands,

        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
