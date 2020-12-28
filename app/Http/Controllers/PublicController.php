<?php

namespace App\Http\Controllers;

use App\Department;
use App\Division;
use App\Mail\FormApplication;
use App\Mail\FormContact;
use App\Product;
use App\SubDepartment;
use App\Career;
use App\Applicantlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mail;
use File;

class PublicController extends Controller
{
    public function index()
    {
        $this->CONVERTFILES();
        $ctlinks = DB::table('ctlinks')->where('status', 1)->orderBy('order', 'asc')->get();
        $brands = DB::table('ctbrands')->where('status', 1)->whereNotNull('imageFile')->get();
        $totalbranches = DB::table('ctbranches')->where('status', 1)->count();
        // dd($brands);
        return view('index', [
            'ctlinks' => $ctlinks,
            'brands' => $brands,
            'totalbranches' => $totalbranches
        ]);
    }

    public function index_test()
    {

        $ctlinks = DB::table('ctlinks')->where('status', 1)->orderBy('order', 'asc')->get();
        $brands = DB::table('ctbrands')->where('status', 1)->whereNotNull('imageFile')->get();
        $totalbranches = DB::table('ctbranches')->where('status', 1)->count();
        // dd($brands);
        return view('index_test', [
            'ctlinks' => $ctlinks,
            'brands' => $brands,
            'totalbranches' => $totalbranches
        ]);
    }


    public function about()
    {
        $totalbranches = DB::table('ctbranches')->where('status', 1)->count();
        return view('about', ['totalbranches' => $totalbranches]);
    }

    public function productprofile($id)
    {
        $product = DB::table('ctproducts')->where('idProduct', $id)->get();
        return view('productprofile', ['products' => $product]);
    }

    public function convertImageToWebP($source, $destinationfile, $quality = 70)
    {

        // $source = asset('assets/img/banner/Home.jpg');
        $image = '';
        $destination = public_path('assets/img/featuredwebp/');
        // $destination = asset('assets/img/webp');
        $extension = pathinfo($source, PATHINFO_EXTENSION);

        if ($extension == 'jpeg' || $extension == 'jpg')
            $image = imagecreatefromjpeg($source);
        elseif ($extension == 'gif')
            $image = imagecreatefromgif($source);
        elseif ($extension == 'png')
            $image = imagecreatefrompng($source);


        // , $destination.'Branches.webp'
        return imagewebp($image, $destination . $destinationfile . '.webp', $quality);
    }

    public function CONVERTFILES()
    {
        $path = public_path('assets/img/productwebp');
        $files = File::files($path);

        foreach ($files as $file) {
            $filefrom = pathinfo(basename($file), PATHINFO_FILENAME);
            $filename = basename($filefrom);
            $this->convertImageToWebP($file, $filename);
        }
    }

    public function products(Request $request)
    {

        $first_department_id = Division::with('subcategories')
            ->orderBy('Division', 'asc')
            ->first()->subcategories
            ->first()->idDepartment;

        $search = preg_replace('/[+\-><\(\)~*\"@]+/', ' ', $request->search);
        $subdepartmentsearch = str_replace(' ', '', $search);

        // return array($search);

        // dd($request->search, $request->all()); //! THIS IS THE CODE WHEN FETCHING THE SEARCH REQUEST FROM THE FRONTEND

        if ($request->has('search')) {
            // DB::connection()->enableQueryLog(); 
            $products = Product::select('ctproducts.idProduct', 'ctproducts.idSub', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName', 'ctproducts.prodName', 'ctproducts.availability')
                ->selectRaw("MATCH ({$request->fieldtofilter}) AGAINST (?) AS relevance", array($search))
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->where('ctproducts.availability', '=', 1)
                ->whereRaw("MATCH ({$request->fieldtofilter}) AGAINST (? IN BOOLEAN MODE)", array($search))
                ->orwhereRaw(DB::raw("REPLACE(department_sub.departmentSubName, ' ','') LIKE '%{$subdepartmentsearch}%' "))
                ->orderBy('relevance', 'DESC')
                ->paginate(9);
            $products_featured = Product::search($request->query('search'))
                ->where('isfeatured', 1)
                ->paginate(2);
            // dd($request->fieldtofilter);
        } elseif ($request->has('category')) {
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where([
                    ['ctproducts.isfeatured', 1],
                    ['ctproducts.idDepartmentSub', $request->query('category')],
                    ['ctproducts.availability', 1]
                ])
                ->paginate(2);
        } else {
            $products = Product::select('ctproducts.idProduct', 'ctproducts.idSub', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('showProduct', '1')
                ->where('ctproducts.availability', '=', 1)
                ->paginate(9);
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('ctproducts.isfeatured', 1)
                ->where('ctproducts.availability', 1)
                ->paginate(2);
        }

        $products->appends($request->input());

        // dd($products);

        $subDepartmentsfeatured = SubDepartment::whereNotIn('id', [1, 88])->get();
        $subDepartments = SubDepartment::where('idDepartment', $first_department_id)->orderBy('departmentSubName', 'ASC')->get(['id', 'departmentSubName', 'idDepartment']);

        return view('ProductPerCat', compact('products', 'subDepartments', 'first_department_id', 'products_featured', 'subDepartmentsfeatured'));
    }

    public function productPerCat(Request $request, $category, $department)
    {

        if ($request->has('search')) {
            $search = preg_replace('/[+\-><\(\)~*\"@]+/', ' ', $request->search);
            $subdepartmentsearch = str_replace(' ', '', $request->search);
            $products = Product::select('ctproducts.idProduct', 'ctproducts.idSub', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName', 'ctproducts.prodName', 'ctdepartment.Department', 'ctdivision.Division')
                ->selectRaw("MATCH ({$request->fieldtofilter}) AGAINST (?) AS relevance", array($search))
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('ctdepartment', 'ctproducts.idSub', '=', 'ctdepartment.idDepartment')
                ->leftJoin('ctdivision', 'ctproducts.idParent', '=', 'ctdivision.idDivision')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->where('ctproducts.availability', '=', 1)
                ->whereRaw("MATCH ({$request->fieldtofilter}) AGAINST (? IN BOOLEAN MODE)", array($search))
                ->orwhereRaw(DB::raw("REPLACE(department_sub.departmentSubName, ' ','') like '%{$subdepartmentsearch}%' "))
                ->orderBy('relevance', 'DESC')
                ->paginate(9);
            $products_featured = Product::search($request->query('search'))
                ->where('isfeatured', 1)
                ->paginate(2);
        } elseif ($request->has('category')) {
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where([
                    ['ctproducts.isfeatured', 1],
                    ['ctproducts.idDepartmentSub', $request->query('category')],
                    ['ctproducts.availability', 1]
                ])
                ->paginate(2);
        } elseif ($request->has('subCat')) {
            $idDepartmentSub = $request->get('subCat');
            $products = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName', 'ctdepartment.Department', 'ctdivision.Division')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->leftJoin('ctdepartment', 'ctproducts.idSub', '=', 'ctdepartment.idDepartment')
                ->leftJoin('ctdivision', 'ctproducts.idParent', '=', 'ctdivision.idDivision')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where([
                    ['ctdepartment.Department', 'LIKE', '%' . str_replace('-', ' ', strtolower($department)) . '%'],
                    ['ctdivision.Division', 'LIKE', '%' . str_replace('-', ' ', strtolower($category)) . '%'],
                    ['idDepartmentSub', $idDepartmentSub],
                    ['ctproducts.availability', 1]
                ])
                ->paginate(9);
        } else {
            $orderfield;
            $tiledepartment = array("75", "79", "78", "76");
            if (in_array($department, $tiledepartment)) {
                $orderfield = "FIELD(department_sub.departmentSubName,'ABC','MASTER') DESC,department_sub.departmentSubName";
            } else {
                $orderfield = "FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName";
            }

            // dd($department, str_replace('-', ' ', strtolower($category)));

            $products = Product::select('ctproducts.idProduct', 'ctproducts.idSub', 'ctproducts.details', 'ctproducts.imageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName', 'ctproducts.prodName', 'ctdepartment.Department', 'ctdivision.Division')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->leftJoin('ctdepartment', 'ctproducts.idSub', '=', 'ctdepartment.idDepartment')
                ->leftJoin('ctdivision', 'ctproducts.idParent', '=', 'ctdivision.idDivision')
                ->orderByRaw($orderfield)
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('ctdepartment.Department', 'LIKE', '%' . str_replace('-', ' ', strtolower($department)) . '%')
                ->where('ctdivision.Division', 'LIKE', '%' . str_replace('-', ' ', strtolower($category)) . '%')
                // ->where('department_sub.departmentSubName', 'LIKE', '%' . $department . '%')
                ->where('availability', 1)
                ->paginate(9);
            // return $products;
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('ctproducts.isfeatured', 1)
                ->where('ctproducts.availability', 1)
                ->paginate(2);
        }

        if ($products->isEmpty()) {
            return back()->with('error', 'No Products Found..');
        }

        $products->appends($request->input());
        $department_id = $products->first()->idSub;

        // dd($products, $department_id);
        // $subDepartments = SubDepartment::where('idDepartment', $id)->orderBy('departmentSubName','ASC')->get(['id', 'departmentSubName','idDepartment']);

        // dd(DB::getQueryLog($products));

        // SELECT ctproducts.idDepartmentSub,department_sub.departmentSubName,ctproducts.idSub FROM ctproducts
        // INNER JOIN department_sub ON department_sub.id = ctproducts.idDepartmentSub
        // WHERE idSub = 75
        // GROUP BY ctproducts.idDepartmentSub,department_sub.departmentSubName,ctproducts.idSub
        $subDepartmentsfeatured = SubDepartment::whereNotIn('id', [1, 88])->get();
        $subDepartments = Product::select('ctproducts.idDepartmentSub', 'department_sub.departmentSubName', 'ctproducts.idSub')
            ->leftJoin('department_sub', 'department_sub.id', '=', 'ctproducts.idDepartmentSub')
            ->where('idSub', $department_id)
            ->groupBy('ctproducts.idDepartmentSub', 'department_sub.departmentSubName', 'ctproducts.idSub')
            ->get();


        // return $subDepartments;

        // dd($products, $subDepartments, $department_id);
        return view('ProductPerCat', compact('products', 'subDepartments', 'department_id', 'products_featured', 'subDepartmentsfeatured'));
    }

    public function featuredProducts(Request $request)
    {
        $subDepartments = SubDepartment::whereNotIn('id', [1, 88])->get();
        if ($request->has('search')) {
            $products_featured = Product::search($request->query('search'))
                ->where('isfeatured', 1)
                ->paginate(2);
        } elseif ($request->has('category')) {
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where([
                    ['ctproducts.isfeatured', 1],
                    ['ctproducts.idDepartmentSub', $request->query('category')],
                    ['ctproducts.availability', 1]
                ])
                ->paginate(2);
        } else {
            $products_featured = Product::select('ctproducts.idProduct', 'ctproducts.details', 'ctproducts.imageFile', 'ctproducts.feaImageFile', 'ctbrands.imageFile as brandImageFile', 'ctbrands.brandName', 'department_sub.departmentSubName')
                ->leftJoin('ctbrands', 'ctproducts.idBrand', '=', 'ctbrands.idBrand')
                ->leftJoin('department_sub', 'ctproducts.idDepartmentSub', '=', 'department_sub.id')
                ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
                ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
                ->where('ctproducts.isfeatured', 1)
                ->where('ctproducts.availability', 1)
                ->paginate(2);
        }
        if ($products_featured->isEmpty()) {
            return view('ProductPerCat', compact('subDepartments'))->with('error', ["No Featured Products Found.."]);
        }

        return view('ProductPerCat', compact('products_featured', 'subDepartments'));
    }

    public function branches()
    {
        $totalbranches = DB::table('ctbranches')->where('status', 1)->count();
        return view('branches', ['totalbranches' => $totalbranches]);
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

        if ($islandGroup === "1") {
            $islandGroupName = 'Luzon';
        } elseif ($islandGroup === "2") {
            $islandGroupName = 'Visayas';
        } else {
            $islandGroupName = 'Mindanao';
        }

        return view('branch', ['branch' => $branch, 'branch_except' => $except_branches, 'long' => $google_coords[1], 'lat' => $google_coords[0], 'islandName' => $islandGroupName]);
    }

    public function careersAjax(Request $request)
    {

        if ($request->isMethod('post')) {

            $id = $request->input('jobcat_id');

            //            return response()->json(['response' => $id]);
            $def_careers = DB::table('ctcareers')->where([['catID', $id], ['status', 1]])->orderBy('dbstat', 'asc')->get();
            return view('ajax.careers', ['def_careers' => $def_careers]);
        }

        $def_careers = DB::table('ctcareers')->where([['catID', 2], ['status', 1]])->orderBy('dbstat', 'asc')->get();

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
            //pit 09-16-18
            $careers = Career::where('status', 1)->pluck('jobTitle', 'jobTitle');
            //default value on your combobox make sure empty space trigger the require
            // $branches = DB::table('ctbranches')->where('status', 1)->pluck('branchName', 'branchName');


            $careers->prepend('Please select a Position', '');
            // $branches->prepend('Please select a Branch','');


            return view('ajax.modal', ['modal_id' => $source_id])
                ->with('careers', $careers);
            // ->with('branches', $branches);

        }
    }

    //Getting branch name and email based on vacant job location
    public function getcareeerBranch(Request $request)
    {
        $vacantJob = $request->input('text');

        $jobId = DB::table('ctcareers')
            ->where('jobTitle', $vacantJob)
            ->pluck('branchId');

        $category = DB::table('ctcareers')
            ->where('jobTitle', $vacantJob)
            ->pluck('catID');

        // dd($category);

        $branchName = DB::table('ctbranches')
            ->select('branchName')
            ->where('status', '=', 1)
            ->whereIn('idBranch', explode(",", $jobId[0]))
            ->get();
        $emailAdd = DB::table('ctbranches')
            ->select('email')
            ->where('status', '=', 1)
            ->whereIn('idBranch', explode(",", $jobId[0]))
            ->get();

        return json_encode(['branchName' => $branchName, 'email' => $emailAdd, 'category' => $category]);
    }

    public function getcareerbranchEmail(Request $request)
    {

        $branchName = $request->input('branch');

        $branchMail = DB::table('ctbranches')
            ->select('email')
            ->where('status', '=', 1)
            ->where('branchName', $branchName)
            ->get();

        return json_encode(['email' => $branchMail]);
    }

    public function emailSumbit(Request $request)
    {


        $form_id = $request->input('form_id');
        // dd($request->all());

        $sendTo = "decoarts.emailforward@gmail.com";

        // dd($request->all());

        if ($form_id == 'contactForm') {

            $validateContact = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required|min:10',
            ]);

            // info@citihardware.com

            Mail::to($sendTo)->send(new FormContact($request->all()));
            // Mail::to('alibasserlalao@gmail.com')->send(new FormContact($request->all()));  

        } elseif ($form_id == 'applyForm') {

            if ($request['branchVal'] == 'Warehouse and Logistics') {

                $validateApplication = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email'
                ]);

                Mail::to($sendTo)
                    ->cc([
                        'anx.hr@citihardware.com',
                        'twh.hr@citihardware.com',
                        'pwh.hr@citihardware.com',
                        'mdc.hr@citihardware.com'
                    ])
                    ->send(new FormApplication($request->all()));

                $response['success'] = 'Success!!';
            } else {
                if ($request['branchVal'] == 'Davao') {
                    dd('Wakanda Forever!!!');
                } else {
                    $validateApplication = $request->validate([
                        'name' => 'required',
                        'email' => 'required|email'
                    ]);

                    Mail::to($sendTo)->send(new FormApplication($request->all()));

                    $response['success'] = 'Success!!';
                }
            }
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

    public function LOAD_TOOLTIP()
    {
        $data = DB::table('ctbranches')
            ->select('branchName', 'tooltipx', 'tooltipy')
            ->where('status', '=', 1)
            ->get();
        return response()->json(['data' => $data]);
    }
}
