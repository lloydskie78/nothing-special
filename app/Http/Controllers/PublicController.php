<?php

namespace App\Http\Controllers;

use App\Department;
use App\Division;
use App\Mail\FormApplication;
use App\Mail\FormContact;
use App\Product;
use App\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mail;

class PublicController extends Controller
{
    //

    public function index()
    {

        $ctlinks = DB::table('ctlinks')->where('status', 1)->orderBy('order','asc')->get();
        $brands = DB::table('ctbrands')->where('status', 1)->get();
        return view('index', [
            'ctlinks' => $ctlinks,
            'brands' => $brands
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function products(Request $request)
    {
        $first_department_id = Division::with('subcategories')
            ->orderBy('Division','asc')
            ->first()->subcategories
            ->first()->idDepartment;

        if ($request->has('search')) {
            $products = Product::search($request->query('search'))
                ->paginate(9);

        }else{
            $products = Product::select('ctproducts.idProduct', 'ctproducts.idSub', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('idSub', $first_department_id)
                ->paginate(9);
        }
        $products->appends($request->input());
        $subDepartments = SubDepartment::where('idDepartment', $first_department_id)->orderBy('departmentSubName','ASC')->get(['id', 'departmentSubName','idDepartment']);
        return view('ProductPerCat', compact('products', 'subDepartments', 'department_id'));
    }


    public function productPerCat(Request $request, $id)
    {
        if ($request->has('search')) {
            $products = Product::search($request->query('search'))
                ->paginate(9);

//            dd($products);
        } elseif($request->has('subCat')){

            $idDepartmentSub = $request->get('subCat');
            $products = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where([
                    ['idSub', $id],
                    ['idDepartmentSub', $idDepartmentSub]
                ])
                ->paginate(9);
        }
        else {
            $products = Product::select('ctproducts.idProduct', 'ctproducts.idSub', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('idSub', $id)
                ->paginate(9);
        }

        if ($products->isEmpty()) {
            return back()->with('error', 'No Products Found..');
        }

        $products->appends($request->input());
        $department_id = $products->first()->idSub;
        $subDepartments = SubDepartment::where('idDepartment', $id)->orderBy('departmentSubName','ASC')->get(['id', 'departmentSubName','idDepartment']);
        return view('ProductPerCat', compact('products', 'subDepartments', 'department_id'));
    }

    public function featuredProducts(Request $request)
    {
        $subDepartments = SubDepartment::whereNotIn('id',[1,88])->get();
        if ($request->has('search')) {
            $products_featured = Product::search($request->query('search'))
                ->where('isfeatured', 1)
                ->paginate(2);

        }elseif($request->has('category')){
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile','ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where([
                    ['ctproducts.isfeatured', 1],
                    ['ctproducts.idDepartmentSub',$request->query('category')]
                    ])
                ->paginate(2);
        }else{
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile','ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('ctproducts.isfeatured', 1)
                ->paginate(2);
        }
        if ($products_featured->isEmpty()) {
            return view('featuredProducts',compact('subDepartments'))->with('error', ["No Featured Products Found.."]);
        }

        return view('featuredProducts', compact('products_featured', 'subDepartments'));
    }

    public function branches()
    {
        return view('branches');
    }

    public function careers()
    {

        $jobcat = DB::table('ctjobcategories')->where('id', '!=', 1)->get();
        return view('careers', ['jobcat' => $jobcat]);
    }

    public function newsAndUpdates()
    {

        $news_list = DB::table('ctnews')->where('status', 'A')->orderBy('datePosted', 'asc')->paginate(5);
        return view('news', compact('news_list'));
    }

    public function branch($id)
    {

        $branch = DB::table('ctbranches')->where('idBranch', $id)->first();

        $islandGroup = $branch->islandGroup;
        $except_branches = DB::table('ctbranches')->where([['islandGroup', $islandGroup], ['idBranch', '!=', $id]])->get();

        $google_coords = $branch->latlng;
        $google_coords = explode(',', $google_coords);

        if($islandGroup === "1"){
            $islandGroupName = 'Luzon';
        }elseif ($islandGroup === "2"){
            $islandGroupName = 'Visayas';
        }else{
            $islandGroupName = 'Mindanao';
        }
        return view('branch', ['branch' => $branch, 'branch_except' => $except_branches, 'long' => $google_coords[1], 'lat' => $google_coords[0], 'islandName' => $islandGroupName]);
    }

    public function careersAjax(Request $request)
    {

        if ($request->isMethod('post')) {

            $id = $request->input('jobcat_id');

//            return response()->json(['response' => $id]);
            $def_careers = DB::table('ctcareers')->where([['catID', $id], ['status', 1]])->orderBy('dbstat','asc')->get();
            return view('ajax.careers', ['def_careers' => $def_careers]);
        }

        $def_careers = DB::table('ctcareers')->where([['catID', 2], ['status', 1]])->orderBy('dbstat','asc')->get();
        return view('ajax.careers', ['def_careers' => $def_careers]);
    }

    public function productsAjax(Request $request)
    {

        if ($request->isMethod('post')) {

            $catId = $request->input('idCat');

            $products = DB::table('ctproducts')->where('idSub', $catId)->get();
//            return response()->json(['response' => $id]);
            return view('ajax.products', ['products' => $products]);
        }
    }

    public function modalAjax(Request $request)
    {

        if ($request->isMethod('post')) {

            $source_id = $request->input('source_id');

            return view('ajax.modal', ['modal_id' => $source_id]);
        }
    }

    public function emailSumbit(Request $request)
    {
        $form_id = $request->input('form_id');


        if ($form_id == 'contactForm') {

            $validateContact = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:10',
            ]);

            Mail::to('info@citihardware.com', 'webmaster@citihardware.com')->send(new FormContact($request->all()));

        } elseif ($form_id == 'applyForm') {

            $validateApplication = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ]);

            Mail::to('info@citihardware.com', 'webmaster@citihardware.com')->send(new FormApplication($request->all()));

            $response['success'] = 'Success!!';

        } else {
            $response['error'] = 'Error!!!';
        }

        return response()->json();
    }

    public function productSearch(Request $request)
    {
        $search_results = Product::search($request['query'])->get();

        return view('ajax.productSearch', compact('search_results'));
    }


}
