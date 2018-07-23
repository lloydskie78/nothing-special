<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Brand;
use App\Career;
use App\Department;
use App\Division;
use App\News;
use App\SubDepartment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

use App\Product;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole:hr,admin');
    }

    public function index()
    {
        $products = Product::all();
        return view('admin.dashboard',compact('products'));
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

    public function departmentSub(){
        return view('admin.subDepartment');
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
                } else {
                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);
                }

                $data = $brand->update($update);

                break;
            case 'product_edit':
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
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

                    $update = array_merge(['imageFile' => $input['imageFile']],$request->except(['_token', 'form_id', 'idToBeUpdated','imageFile','feaImageFile']));

                }else if ($request->hasFile('imageFile')) {
                    $image = $request->file('imageFile');
                    $input['imageFile'] = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products');
                    $image->move($destinationPath, $input['imageFile']);
                    $update = array_merge(['imageFile' => $input['imageFile']],$request->except(['_token', 'form_id', 'idToBeUpdated','imageFile']));
                }else if($request->hasFile('feaImageFile')){

                    $feaImage = $request->file('feaImageFile');
                    $input['feaImageFile'] = pathinfo($feaImage->getClientOriginalName(),PATHINFO_FILENAME) . '.' . $feaImage->getClientOriginalExtension();
                    $destinationPath = public_path('assets/img/products/featuredImage');
                    $feaImage->move($destinationPath, $input['feaImageFile']);
                    $update = array_merge(['feaImageFile' => $input['feaImageFile']],$request->except(['_token', 'form_id', 'idToBeUpdated','feaImageFile']));

                }else {
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
                    $update = array_merge(['imageFile' => $input['imageFile']],$request->except(['_token', 'form_id', 'idToBeUpdated','imageFile']));
                }else{
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
                    $branch->imageFile = $input['imageFile'];
                    $update = array_merge(['imageFile' => $input['imageFile']],$request->except(['_token', 'form_id', 'idToBeUpdated','imageFile']));
                }else{
                    $update = $request->except(['_token', 'form_id', 'idToBeUpdated']);
                }

                $data = $branch->update($update);
                break;
            case 'career_edit':
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);

                $career = Career::whereIn('idJob', $id);
                $data = $career->update($request->except(['_token', 'form_id', 'idToBeUpdated']));
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

                    $input['feaImageFile'] = pathinfo($feaImage->getClientOriginalName(),PATHINFO_FILENAME) . '.' . $feaImage->getClientOriginalExtension();

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

                $career = Career::where('catId',$request['catID'])->orderBy('dbstat','DESC')->first();
                $dbstat = $career->dbstat++;

                $data = new Career();
                $data->dbstat = $dbstat;
                $data->fill($request->except(['_token', 'form_id']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $data->save();
                break;
            case 'division_add':
                $data = new Division();
                $data->fill($request->except(['_token', 'form_id','EBSid']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $data->save();
                break;
            case 'department_add':
                $data = new Department();
                $data->fill($request->except(['_token', 'form_id','EBSid']));
                $this->validate($request, [

                    'imageFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ]);
                $data->save();
                break;
            case 'subDepartment_add':
                $data = new SubDepartment();
                $data->fill($request->except(['_token', 'form_id','EBSid']));
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

    public function db_delete(Request $request)
    {
        $rows = explode(',',$request->input('rows'));
        $imagePath = public_path().'/assets/img/';
        switch ($request->input('table')) {
            case 'brand_table':
                $imageRows = Brand::whereIn('idBrand',$rows)->pluck('imageFile');
                foreach ($imageRows as $image){
                    $file = File::delete($imagePath.'brands/'.$image);
                }

                $data = Brand::destroy($rows);
                break;
            case 'product_table':
                $imageRows = Product::whereIn('idProduct',$rows)->get(['imageFile','feaImageFile']);

                foreach ($imageRows as $image){
                    $file = File::delete($imagePath.'products/'.$image->imageFile);
                    $feaFile = File::delete($imagePath.'products/featuredImage/'.$image->feaImageFile);
                }
                $data = Product::destroy($rows);
                break;
            case 'news_table':
                $imageRows = News::whereIn('idNews',$rows)->pluck('imageFile');
                foreach ($imageRows as $image){
                    $file = File::delete($imagePath.'news/'.$image);
                }
                $data = News::destroy($rows);
                break;
            case 'branch_table':
                $imageRows = Branch::whereIn('idBranch',$rows)->pluck('imageFile');
                foreach ($imageRows as $image){
                    $file = File::delete($imagePath.'branch/'.$image);
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
                    ->addColumn('date_posted',function ($data){

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
                    ->addColumn('job_category',function($data){
                        return $data->jobcategory->name;
                    })
                    ->make(true);
                break;
            case 'departments':
                $department = Department::with('division');
                return Datatables::of($department)
                    ->addColumn('equi_division',function($data){
                        return $data->division['Division'];
                    })
                    ->make(true);
                break;
            case 'divisions':
                $db_table = 'ctdivision';
                break;
            case 'subDepartments';
                $subDeparment = SubDepartment::select('ctdepartment.idDepartment as department_id','ctdepartment.Department','department_sub.departmentSubName','department_sub.status','department_sub.id')->
                    leftJoin('ctdepartment','department_sub.idDepartment','=','ctdepartment.idDepartment')->get();

              return Datatables::of($subDeparment)
                    ->addColumn('category_name',function($data){
                        return $data->Department;
                    })
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
}
