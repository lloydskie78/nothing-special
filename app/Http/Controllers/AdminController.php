<?php

namespace App\Http\Controllers;

use App\Link;
use App\News;
use App\User;
use App\Brand;
use App\Banner;
use App\Branch;
use App\Career;
use App\Product;
use App\Division;
use Carbon\Carbon;
use App\Department;
use App\SubDepartment;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function BRANCH_API()
    {
        $branch = DB::table('ctbranches');
        return response()->json(['data' => $branch], 200);
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole:hr,admin');
    }

    public function index()
    {
        // $this->CONVERTFILES();
        $products = Product::all();
        $users = User::all();

        return view('admin.dashboard', compact('products', 'users'));
    }

    public function brands()
    {
        return view('admin.brands');
    }

    public function posts()
    {

        return view('admin.posts');
    }

    public function products()
    {

        return view('admin.products');
    }

    public function branches()
    {

        return view('admin.branches');
    }

    public function careers()
    {

        return view('admin.careers');
    }

    public function department()
    {
        return view('admin.department');
    }

    public function division()
    {
        return view('admin.division');
    }

    public function departmentSub()
    {
        return view('admin.subDepartment');
    }

    public function banner()
    {
        return view('admin.banner');
    }

    public function link()
    {
        return view('admin.link');
    }

    public function productarchive()
    {
        return view('admin.productarchive');
    }

    //DATABASE INTERACTIONS
    public function editItem(Request $request)
    {
        $id = explode(',', $request->input('idToBeUpdated'));

        switch ($request->input('form_id')) {
            case 'brand_edit':

                $this->validate($request, [
                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $brand = Brand::whereIn('idBrand', $id);

                if ($request->hasFile('imageFile')) {
                    $image = $request->file('imageFile');
                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/brands');
                    $image->move($destinationPath, $input['imageFile']);
                    $update = array_merge(['imageFile' => $input['imageFile']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'imageFile']));

                    // create copy in webp
                    $filename = pathinfo($input['imageFile'], PATHINFO_FILENAME);
                    $filepath = $destinationPath . '/' . $input['imageFile'];
                    $this->convertImageToWebP($filepath, $filename, 'brand');
                } else {
                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);
                }

                $data = $brand->update($update);

                break;
            case 'product_edit':

                $this->validate($request, [
                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:1048',
                ]);

                // $request->image('imageFile')->rules('mimes:jpeg,bmp,png,gif,svg,webp');

                $product = Product::whereIn('idProduct', $id);

                if ($request->hasFile('imageFile') && $request->hasFile('feaImageFile')) {
                    $image = $request->file('imageFile');
                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products');
                    $image->move($destinationPath, $input['imageFile']);

                    $feaImage = $request->file('feaImageFile');
                    $input['feaImageFile'] = $feaImage->getClientOriginalName() . '.' . $feaImage->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products/featuredImage');
                    $feaImage->move($destinationPath, $input['feaImageFile']);

                    $filepath = $destinationPath . '/' . $input['imageFile'];

                    //after the image is uploaded you need to create a copy in webp

                    $update = array_merge(['imageFile' => $input['imageFile']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'imageFile', 'feaImageFile']));

                    $filename = pathinfo($input['imageFile'], PATHINFO_FILENAME);
                    $filepath = $destinationPath . '/' . $input['imageFile'];
                    $this->convertImageToWebP($filepath, $filename, 'product');
                } else if ($request->hasFile('imageFile')) {
                    $image = $request->file('imageFile');
                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products');
                    $image->move($destinationPath, $input['imageFile']);
                    $update = array_merge(['imageFile' => $input['imageFile']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'imageFile']));
                } else if ($request->hasFile('feaImageFile')) {

                    $feaImage = $request->file('feaImageFile');
                    $input['feaImageFile'] = pathinfo($feaImage->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $feaImage->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products/featuredImage');
                    $feaImage->move($destinationPath, $input['feaImageFile']);
                    $update = array_merge(['feaImageFile' => $input['feaImageFile']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'feaImageFile']));
                } else {
                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);
                }

                $data = $product->update($update);
                break;
            case 'news_edit':

                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                $news = News::whereIn('idNews', $id);

                if ($request->hasFile('imageFile')) {


                    $image = $request->file('imageFile');

                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/news');

                    $image->move($destinationPath, $input['imageFile']);
                    $update = array_merge(['imageFile' => $input['imageFile']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'imageFile']));
                } else {
                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);
                }

                $data = $news->update($update);
                break;
            case 'branch_edit':
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                $branch = Branch::whereIn('idBranch', $id);

                if ($request->hasFile('imageFile')) {


                    $image = $request->file('imageFile');

                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/branch');

                    $image->move($destinationPath, $input['imageFile']);
                    $branch->imageFil8e = $input['imageFile'];
                    $update = array_merge(['imageFile' => $input['imageFile']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'imageFile']));
                } else {
                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);
                }

                $data = $branch->update($update);

                break;
            case 'career_edit':

                try {
                    $this->validate($request, [
                        'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    if (!isHTML($request->desc)) {
                        $ulMarkup = GenerateUlMarkUp($request->desc);
                    } else {
                        $ulMarkup = $request->desc;
                    }

                    //? CATCHING EMPTY ARRAYS
                    if (empty($request->luzBranchEdit)) {
                        $request->luzBranchEdit = array();
                        $request->luzBranchEdit['0'] = "0";
                    }
                    if (empty($request->visBranchEdit)) {
                        $request->visBranchEdit = array();
                        $request->visBranchEdit['0'] = "0";
                    }
                    if (empty($request->minBranchEdit)) {
                        $request->minBranchEdit = array();
                        $request->minBranchEdit['0'] = "0";
                    }

                    $selectedBranches = implode(', ', $request->luzBranchEdit) . ', ' . implode(', ', $request->visBranchEdit) . ', ' . implode(', ', $request->minBranchEdit);

                    $request->merge(['desc' => $ulMarkup]);
                    $career = Career::whereIn('idJob', $id);

                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated', 'luzBranchEdit', 'visBranchEdit', 'minBranchEdit']);
                    $update['branchId'] = $selectedBranches;

                    $data = $career->update($update);
                } catch (\Throwable $th) {
                    return $th;
                }

                break;
            case 'division_edit':
                $this->validate($request, [
                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $career = Division::whereIn('idDivision', $id);
                $data = $career->update($request->except(['_token', 'form_id', 'idToBeUpdated']));
                break;
            case 'department_edit':
                $this->validate($request, [
                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $career = Department::whereIn('idDepartment', $id);
                $data = $career->update($request->except(['_token', 'form_id', 'idToBeUpdated']));
                break;
            case 'subDepartment_edit':
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                $career = SubDepartment::whereIn('id', $id);
                $data = $career->update($request->except(['_token', 'form_id', 'idToBeUpdated']));
                break;
            case 'banner_edit':
                $banner = Banner::whereIn('bannerid', $id);
                $update = $request->except(['_token', 'form_id', 'idToBeUpdated', 'bannerimage', 'pagevideo', 'page']);

                $this->validate($request, [
                    'bannerimage' => 'nullable|image|mimes:jpeg,jpg|max:2048',
                ]);

                $validator = Validator::make($request->all(), [
                    'pagevideo' => 'mimetypes:video/mp4|max:10000',
                ]);


                // |dimensions:width=470,height=702'

                // $error = $validator->errors()->first();
                // $error = $validator->errors();

                // dd($error);

                if ($validator->fails()) {
                    return response()->json(['error' => 'the filesize of your video is too large'], 200);
                }

                if ($request->hasFile('pagevideo')) {

                    $image = $request->file('pagevideo');

                    $input['pagevideo'] = $request->page . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/banner');

                    $image->move($destinationPath, $input['pagevideo']);
                    $banner->pagevideo = $input['pagevideo'];
                    $update = array_merge(['pagevideo' => $input['pagevideo']], $update);
                }

                if ($request->hasFile('bannerimage')) {

                    $image = $request->file('bannerimage');

                    $input['bannerimage'] = $request->page . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/banner');

                    $image->move($destinationPath, $input['bannerimage']);
                    $banner->bannerimage = $input['bannerimage'];
                    $update = array_merge(['bannerimage' => $input['bannerimage']], $update);

                    $filename = pathinfo($input['bannerimage'], PATHINFO_FILENAME);
                    $filepath = $destinationPath . '/' . $input['bannerimage'];
                    $this->convertImageToWebP($filepath, $filename, 'banner');
                }

                $data = $banner->update($update);
                break;
            case 'link_edit':
                $link = Link::whereIn('id', $id);

                $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);

                $this->validate($request, [
                    'image' => 'nullable|image|mimes:jpeg,jpg|max:2048',
                ]);

                if ($request->hasFile('image')) {

                    $image = $request->file('image');
                    $input['image'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/featured');
                    $image->move($destinationPath, $input['image']);
                    $link->image = $input['image'];
                    $update = array_merge(['image' => $input['image']], $request->except(['_token', 'form_id', 'idToBeUpdated', 'image']));


                    $filename = pathinfo($input['imageFile'], PATHINFO_FILENAME);
                    $filepath = $destinationPath . '/' . $input['imageFile'];
                    $this->convertImageToWebP($filepath, $filename, 'link');
                }
                $data = $link->update($update);
                break;
            default:
                return response()->json(['error' => 'Uknown Error!!'], 412);
        }

        if ($data == null) {
            return response()->json(['error' => $data ?? 'Unknown Error'], 412);
        } else {
            return response()->json(['success' => 'Edited'], 200);
        }
    }

    public function addItem(Request $request)
    {
        switch ($request->input('form_id')) {
            case 'brand_add':

                $data = new Brand();
                $data->fill($request->except(['_token', 'form_id']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                if ($request->hasFile('imageFile')) {

                    $image = $request->file('imageFile');

                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/brands');

                    $image->move($destinationPath, $input['imageFile']);
                    $data->imageFile = $input['imageFile'];
                } else {
                    // use the file path in the default img
                    $data->imageFile = "na.webp";
                }

                $data->save();

                break;
            case 'product_add':
                $data = new Product();
                $data->fill($request->except(['_token', 'form_id']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                if ($request->hasFile('imageFile')) {
                    $image = $request->file('imageFile');
                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products');
                    $image->move($destinationPath, $input['imageFile']);
                    $data->imageFile = $input['imageFile'];
                }

                if ($request->hasFile('feaImageFile')) {

                    $feaImage = $request->file('feaImageFile');

                    $input['feaImageFile'] = pathinfo($feaImage->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $feaImage->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/products/featuredImage');

                    $feaImage->move($destinationPath, $input['feaImageFile']);
                    $data->feaImageFile = $input['feaImageFile'];
                }

                $data->save();
                break;
            case 'news_add':
                $data = new News();
                $data->fill($request->except(['_token', 'form_id']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                if ($request->hasFile('imageFile')) {

                    $image = $request->file('imageFile');
                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/news');
                    $image->move($destinationPath, $input['imageFile']);
                    $data->imageFile = $input['imageFile'];
                }

                $data->save();
                break;
            case 'branch_add':
                $data = new Branch();
                $data->fill($request->except(['_token', 'form_id']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                if ($request->hasFile('imageFile')) {


                    $image = $request->file('imageFile');

                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();

                    $destinationPath = public_path('assets/img/branch');

                    $image->move($destinationPath, $input['imageFile']);
                    $data->imageFile = $input['imageFile'];
                }

                $data->save();
                break;
            case 'career_add':

                $ulMarkup = GenerateUlMarkUp($request->desc);
                $request->merge(['desc' => $ulMarkup]);
                $career = Career::where('catId', $request['catID'])->orderBy('dbstat', 'DESC')->first();
                $dbstat = $career->dbstat++;
                $data = new Career();
                $data->dbstat = $dbstat;
                $data->fill($request->except(['_token', 'form_id', 'branchId']));
                $this->validate($request, [
                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                //? CATCHING EMPTY ARRAYS
                if (empty($request->luzBranch)) {
                    $request->luzBranch = array();
                    $request->luzBranch['0'] = "0";
                }
                if (empty($request->visBranch)) {
                    $request->visBranch = array();
                    $request->visBranch['0'] = "0";
                }
                if (empty($request->minBranch)) {
                    $request->minBranch = array();
                    $request->minBranch['0'] = "0";
                }

                $data->branchId = implode(',', $request->luzBranch) . ',' . implode(',', $request->visBranch) . ',' . implode(',', $request->minBranch);

                // dd($data);

                if ($request->input('branchId')) {
                    $data->branchId =   implode(",", $request->input('branchId'));
                }

                $data->save();
                break;
            case 'division_add':
                $data = new Division();
                $data->fill($request->except(['_token', 'form_id', 'EBSid']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $data->save();
                break;
            case 'department_add':
                $data = new Department();
                $data->fill($request->except(['_token', 'form_id', 'EBSid']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $data->save();
                break;
            case 'subDepartment_add':
                $data = new SubDepartment();
                $data->fill($request->except(['_token', 'form_id', 'EBSid']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $data->save();
                break;
            default:
                return response()->json(['error' => 'Unknown Error!!'], 412);
        }

        if ($data == null) {
            return response()->json(['error' => $data], 412);
        } else {
            return response()->json(['success' => 'Added'], 200);
        }
    }

    public function db_restore(Request $request)
    {
        $rows = explode(',', $request->input('rows'));
        switch ($request->input('table')) {
            case 'brand_table':

                break;
            case 'product_table':

                break;
            case 'productsarchive_table':
                $data = Product::onlyTrashed()->whereIn('idProduct', $rows)->restore();
                break;

            case 'news_table':

                break;
            case 'branch_table':

                break;
            case 'career_table':

                break;
            case 'division_table':

                break;
            case 'department_table':

                break;
            case 'subDepartment_table':

                break;
            default:
                return response()->json(['error' => 'Uknown Error!!'], 412);
        }

        if ($data == null) {
            return response()->json(['error' => $data], 412);
        } else {
            return response()->json('success', 200);
        }
    }

    public function db_harddelete(Request $request)
    {

        $rows = explode(',', $request->input('rows'));
        $imagePath = public_path() . '/assets/img/';
        switch ($request->input('table')) {
            case 'brand_table':
                $imageRows = Brand::whereIn('idBrand', $rows)->pluck('imageFile');
                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'brands/' . $image);
                }

                $data = Brand::forceDelete($rows);
                break;
            case 'productsarchive_table':
                // $imageRows = Product::whereIn('idProduct',$rows)->get(['imageFile','feaImageFile']);
                // foreach ($imageRows as $image){
                //     $file = File::delete($imagePath.'products/'.$image->imageFile);
                //     $feaFile = File::delete($imagePath.'products/featuredImage/'.$image->feaImageFile);
                // }
                $data = Product::onlyTrashed()->whereIn('idProduct', $rows)->forceDelete();
                break;
            case 'news_table':
                $imageRows = News::whereIn('idNews', $rows)->pluck('imageFile');
                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'news/' . $image);
                }
                $data = News::forceDelete($rows);
                break;
            case 'branch_table':
                $imageRows = Branch::whereIn('idBranch', $rows)->pluck('imageFile');
                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'branch/' . $image);
                }
                $data = Branch::forceDelete($rows);
                break;
            case 'career_table':
                $data = Career::forceDelete($rows);
                break;
            case 'division_table':
                $data = Division::forceDelete($rows);
                break;
            case 'department_table':
                $data = Department::forceDelete($rows);
                break;
            case 'subDepartment_table':
                $data = SubDepartment::forceDelete($rows);
                break;
            default:
                return response()->json(['error' => 'Uknown Error!!'], 412);
        }

        if ($data == null) {
            return response()->json(['error' => $data], 412);
        } else {
            return response()->json('success', 200);
        }
    }

    public function db_delete(Request $request)
    {
        $rows = explode(',', $request->input('rows'));
        $imagePath = public_path() . '/assets/img/';
        switch ($request->input('table')) {
            case 'brand_table':
                $imageRows = Brand::whereIn('idBrand', $rows)->pluck('imageFile');
                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'brands/' . $image);
                }

                $data = Brand::destroy($rows);
                break;
            case 'product_table':
                $imageRows = Product::whereIn('idProduct', $rows)->get(['imageFile', 'feaImageFile']);

                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'products/' . $image->imageFile);
                    $feaFile = File::delete($imagePath . 'products/featuredImage/' . $image->feaImageFile);
                }

                $data = Product::destroy($rows);
                break;
            case 'news_table':
                $imageRows = News::whereIn('idNews', $rows)->pluck('imageFile');
                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'news/' . $image);
                }
                $data = News::destroy($rows);
                break;
            case 'branch_table':
                $imageRows = Branch::whereIn('idBranch', $rows)->pluck('imageFile');
                foreach ($imageRows as $image) {
                    $file = File::delete($imagePath . 'branch/' . $image);
                }
                $data = Branch::destroy($rows);
                break;
            case 'career_table':
                $data = Career::destroy($rows);
                break;
            case 'division_table':
                $data = Division::destroy($rows);
                break;
            case 'department_table':
                $data = Department::destroy($rows);
                break;
            case 'subDepartment_table':
                $data = SubDepartment::destroy($rows);
                break;
            default:
                return response()->json(['error' => 'Uknown Error!!'], 412);
        }

        if ($data == null) {
            return response()->json(['error' => $data], 412);
        } else {
            return response()->json('success', 200);
        }
    }

    public function ajaxData($table)
    {
        switch ($table) {
            case 'brands':
                $db_table = 'ctbrands';
                break;
            case 'products':
                $model = Product::query();
                // $model = Product::query()->take(10)->get();

                return DataTables::of($model)
                    ->addColumn('brandName', function (Product $product) {
                        $brand = Brand::where('idBrand', $product->idBrand)->first();
                        if ($brand === null) {
                            return 'No Brand';
                        } else {
                            return $brand->brandName;
                        }
                    })->addColumn('parent', function (Product $product) {
                        $parent = Division::where('idDivision', $product->idParent)->first();
                        if ($parent === null) {
                            return 'NULL';
                        } else {
                            return $parent->Division;
                        }
                    })->addColumn('subParent', function (Product $product) {
                        $subParent = Department::where('idDepartment', $product->idSub)->first();
                        if ($subParent === null) {
                            return 'NULL';
                        } else {
                            return $subParent->Department;
                        }
                    })
                    ->make(true);
                break;
            case 'productsarchive':

                $model = Product::onlyTrashed();

                return DataTables::of($model)
                    ->addColumn('brandName', function (Product $product) {
                        $brand = Brand::where('idBrand', $product->idBrand)->first();
                        if ($brand === null) {
                            return 'NULL';
                        } else {
                            return $brand->brandName;
                        }
                    })->addColumn('parent', function (Product $product) {
                        $parent = Division::where('idDivision', $product->idParent)->first();
                        if ($parent === null) {
                            return 'NULL';
                        } else {
                            return $parent->Division;
                        }
                    })->addColumn('subParent', function (Product $product) {
                        $subParent = Department::where('idDepartment', $product->idSub)->first();
                        if ($subParent === null) {
                            return 'NULL';
                        } else {
                            return $subParent->Department;
                        }
                    })
                    ->make(true);

                break;
            case 'news':

                $news = News::query();
                return DataTables::of($news)
                    ->addColumn('date_posted', function ($data) {

                        return $data->created_at->format('F d, Y');
                    })
                    ->make(true);
                break;
            case 'branches':
                $db_table = 'ctbranches';
                break;
            case 'careers':
                $careers = Career::with('jobcategory');
                return Datatables::of($careers)
                    ->addColumn('job_category', function ($data) {
                        return $data->jobcategory->name;
                    })
                    ->make(true);
                break;
            case 'departments':
                $department = Department::with('division');
                return Datatables::of($department)
                    ->addColumn('equi_division', function ($data) {
                        return $data->division['Division'];
                    })
                    ->make(true);
                break;
            case 'link':
                // $link = DB::table('ctlinks')->select('id','image','desc')>where('status', 1)->get();
                $link = Link::query();
                return Datatables::of($link)->make(true);
                break;
            case 'divisions':
                $db_table = 'ctdivision';
                break;
            case 'subDepartments';
                $subDeparment = SubDepartment::select('ctdepartment.idDepartment as department_id', 'ctdepartment.Department', 'department_sub.departmentSubName', 'department_sub.status', 'department_sub.id')->leftJoin('ctdepartment', 'department_sub.idDepartment', '=', 'ctdepartment.idDepartment')->get();

                return Datatables::of($subDeparment)
                    ->addColumn('category_name', function ($data) {
                        return $data->Department;
                    })
                    ->make(true);
                break;
            case 'banner':
                $banner = Banner::query();
                return DataTables::of($banner)
                    ->make(true);
                break;
            default:
                return false;
        }

        return \Yajra\DataTables\Facades\DataTables::of(DB::table($db_table))->make(true);
    }

    public function modalEdit(Request $request)
    {
        $form_id = $request->input('btn_id');

        // dd($form_id);
        // return;

        // dd($request->all());

        $id = explode(',', $request->input('rows'));
        if (count($id) == 1) {
            $id_update = $request->input('rows');
        } else {
            return view('admin.ajax.modalMultiEdit', ['data' => $request->input('rows'), 'form_id' => $form_id]);
        }

        switch ($form_id) {
            case 'brand_edit':
                $data = Brand::find($id_update);
                break;
            case 'product_edit':
                $data = Product::find($id_update);
                break;
            case 'news_edit':
                $data = News::find($id_update);
                break;
            case 'branch_edit':
                $data = Branch::find($id_update);
                break;
            case 'career_edit':
                $data = Career::find($id_update);
                break;
            case 'division_edit':
                $data = Division::find($id_update);
                break;
            case 'department_edit':
                $data = Department::find($id_update);
                break;
            case 'subDepartment_edit':
                $data = SubDepartment::find($id_update);
                break;
            case 'banner_edit':
                $data = Banner::find($id_update);
                break;
            case 'link_edit':
                $data = Link::find($id_update);
                break;
            default:
                return false;
        }

        return view('admin.ajax.modalEdit', ['data' => $data, 'form_id' => $form_id]);
    }

    public function modalAdd(Request $request)
    {
        $form_id = $request->input('btn_id');

        return view('admin.ajax.modalAdd', ['form_id' => $form_id]);
    }
    //Additional functions Aug 28, 2019 dev: Pit

    public function imageUploadPost(Request $request)
    {
        if ($request->hasFile('imageFile')) {

            //check if the file is png ,dimension and file size
            $validator = Validator::make($request->all(), [
                'imageFile' => 'required|image|mimes:png,svg|max:1048|dimensions:width=470,height=702'
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Invalid dimension or file type'], 200);
            }

            $image = $request->file('imageFile');
            $input['imageFile'] = 'map.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/img/');
            $image->move($destinationPath, $input['imageFile']);
            return response()->json(['success' => 'Edited'], 200);
            return view('admin.ajax.modalSetmap');
        } else {
            return response()->json(['error' => 'There is no file selected'], 200);
        }
    }

    public function setXY(Request $request)
    {
        $id = $request->id;
        $result = DB::table('ctbranches')->where('idBranch', $id)->first();
        return view('admin.ajax.modalMap', ['tooltipx' => $request->tooltipx, 'tooltipy' => $request->tooltipy, 'id' => $result->idBranch, 'branch' => $result->branchName]);
    }

    public function modalMap(Request $request)
    {
        $id = $request->id;

        $result = DB::table('ctbranches')->where('idBranch', $id)->first();
        // dd($result);
        return view('admin.ajax.modalMap', ['tooltipx' => $result->tooltipx, 'tooltipy' => $result->tooltipy, 'id' => $result->idBranch, 'branch' => $result->branchName]);
    }

    public function SAVE_TOOLTIP(Request $request)
    {
        Branch::where('idBranch', $request->id)->update(array('tooltipx' => $request->tooltipx, 'tooltipy' => $request->tooltipy));
        return response()->json(['success' => 'Edited'], 200);
    }

    public function setMap(Request $request)
    {
        return view('admin.ajax.modalSetmap');
    }

    public function convertImageToWebP($source, $destinationfile, $module, $quality = 70)
    {

        // $source = asset('assets/img/banner/Home.jpg');
        $image = '';

        if ($module === 'product') {
            $destination = public_path('assets/img/productwebp/');
        } else if ($module === 'brand') {
            $destination = public_path('assets/img/brandwebp/');
        } else if ($module === 'link') {
            $destination = public_path('assets/img/featuredwebp/');
        } else if ($module === 'banner') {
            $destination = public_path('assets/img/bannerwebp/');
        }

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
        $path = public_path('assets/img/featured');
        $files = File::files($path);

        foreach ($files as $file) {
            $filefrom = pathinfo(basename($file), PATHINFO_FILENAME);
            $filename = basename($filefrom);
            // $this->convertImageToWebP($file,$filename);
            // dd($file);
        }
    }

    public function departmentSelect(Request $request)
    {
        $dept = Department::where('idDivision', $request->division)->get();

        return json_encode(['department' => $dept]);
    }

    public function subDepartmentSelect(Request $request)
    {
        $subDept = SubDepartment::where('idDepartment', $request->subDepartment)->get();

        return json_encode(['subDepartment' => $subDept]);
    }
}
