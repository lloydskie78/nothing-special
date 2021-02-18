<?php

namespace App\Providers;

use App\Brand;
use App\Department;
use App\Division;
use App\JobCategory;
use App\SubDepartment;
use App\Branch;
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

        $luz = DB::table('ctbranches')->where('islandGroup', 1)->orderBy('branchName', 'asc')->get();
        $vis = DB::table('ctbranches')->where('islandGroup', 2)->orderBy('branchName', 'asc')->get();
        $min = DB::table('ctbranches')->where('islandGroup', 3)->orderBy('branchName', 'asc')->get();
        $branches = DB::table('ctbranches')->orderBy('branchName', 'asc')->get();
        $branchesCount = DB::table('ctbranches')->count();
        $brandSpecific = Brand::select('idBrand', 'brandName', 'imageFile')
            ->where('brandName', 'LIKE', '%La Fonza%')
            ->orWhere('brandName', 'LIKE', '%Boston Bay%')
            ->orWhere('brandName', 'LIKE', '%Hausmann%')
            ->orWhere('brandName', 'LIKE', '%Designcraft%')
            ->orWhere('brandName', 'LIKE', '%Nuvogres%')
            ->orWhere('brandName', 'LIKE', '%Voda%')
            ->orWhere('brandName', 'LIKE', '%NZ Wood%')
            ->orWhere('brandName', 'LIKE', '%Philippine Standard%')
            ->orWhere('brandName', 'LIKE', '%Arko%')
            ->orWhere('brandName', 'LIKE', '%Stack%')
            ->orWhere('brandName', 'LIKE', '%Ryker%')
            ->orWhere('brandName', 'LIKE', '%Duma%')
            ->orWhere('brandName', 'LIKE', '%Weber%')
            ->orWhere('brandName', 'LIKE', '%Geberit%')
            ->orWhere('brandName', 'LIKE', '%3M%')
            ->orWhere('brandName', 'LIKE', '%Ledvance%')
            ->orWhere('brandName', 'LIKE', '%Boysen%')
            ->orWhere('brandName', 'LIKE', '%Nippon%')
            ->orWhere('brandName', 'LIKE', '%Yale%')
            ->orWhere('brandName', 'LIKE', '%Panasonic%')
            ->orWhere('brandName', 'LIKE', '%Einhell%')
            ->orWhere('brandName', 'LIKE', '%Werner%')
            ->get();
        $wall_and_floor = SubDepartment::where('idDepartment', 75)->get();
        $categories = Division::where('division_status', 1)->orderBy('Division', 'asc')->with('subcategories')->get();
        $brands = Brand::where('status', 1)->get();
        $select_branch = selectArray(Branch::BranchAscending()->where('status', '1')->orderBy('branchName', 'ASC')->get(), 'branchName', 'idBranch');
        $select_branch_luzon = selectArray(Branch::BranchAscending()->where('islandGroup', 1)->orderBy('branchName', 'ASC')->get(), 'branchName', 'idBranch');
        $select_branch_visayas = selectArray(Branch::BranchAscending()->where('islandGroup', 2)->orderBy('branchName', 'ASC')->get(), 'branchName', 'idBranch');
        $select_branch_mindanao = selectArray(Branch::BranchAscending()->where('islandGroup', 3)->orderBy('branchName', 'ASC')->get(), 'branchName', 'idBranch');
        $select_divisions = selectArray(Division::DivisionAscending()->where('division_status', '1')->get(), 'Division', 'idDivision');
        $select_departments = selectArray(Department::DepartmentAscending()->where('department_status', '1')->get(), 'Department', 'idDepartment');
        $select_subDepartments = selectArray(SubDepartment::DepartmentSubNameAscending()->where('status', '1')->get(), 'departmentSubName', 'id');
        $select_brands = selectArray(Brand::BrandAscending()->where('status', '1')->get(), 'brandName', 'idBrand');
        $select_jobcat = selectArray(JobCategory::JobCatAscending()->where('id', '!=', '1')->get(), 'name', 'id');
        $select_division = selectArray(Division::DivisionAscending()->where('division_status', '1')->get(), 'Division', 'idDivision');

        // $select_brands= array_merge($select_brands,array('' => 'Please Select'));
        // $select_divisions = array_merge($select_divisions,array('' => 'Please Select'));
        // $select_subDepartments=array_merge($select_subDepartments,array('' => 'Please Select'));
        // $select_departments=array_merge($select_subDepartments,array('' => 'Please Select'));

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
            'select_branch_luzon' => $select_branch_luzon,
            'select_branch_visayas' => $select_branch_visayas,
            'select_branch_mindanao' => $select_branch_mindanao,
            'select_jobcat' => $select_jobcat,
            'select_division' => $select_division,
            'select_branch' => $select_branch,
            'brands' => $brands,
            'branchesCount' => $branchesCount,
            'brandSpecific' => $brandSpecific,
            'wall_and_floor' => $wall_and_floor,
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
