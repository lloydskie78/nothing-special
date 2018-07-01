<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Product;

Route::get('/', 'PublicController@index')->name('main');
Route::get('/about', 'PublicController@about')->name('about');
Route::get('/products', 'PublicController@products')->name('products');
Route::get('/featured', 'PublicController@featuredProducts')->name('featured');
Route::get('/branches', 'PublicController@branches')->name('branches');
Route::get('/careers', 'PublicController@careers')->name('careers');
Route::get('/news', 'PublicController@newsAndUpdates')->name('news');
Route::get('/branch/{id}', 'PublicController@branch')->name('branch');
Route::get('product/category/{departmentId}','PublicController@productPerCat')->name('productPerCat');
Route::get('product/category/{departmentId}/{subDepartmentId}','PublicController@productPerCatAndSubCat')->name('productPerCatAndSubCat');

Route::post('/jobcathandler', 'PublicController@careersAjax');
Route::get('/jobcathandler', 'PublicController@careersAjax');

Route::post('/producthandler', 'PublicController@productsAjax');
Route::get('/producthandler', 'PublicController@productsAjax');
Route::post('/productSearch','PublicController@productSearch');


Route::post('{url}','PublicController@modalAjax')->where(['url' => 'modalhandler']);


Route::post('/sendmail', 'PublicController@emailSumbit');

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('dashboard');
    Route::get('brands', 'AdminController@brands')->name('dashboardBrands');
    Route::get('products', 'AdminController@products')->name('dashboardProducts');
    Route::get('news', 'AdminController@posts')->name('dashboardPosts');
    Route::get('branches', 'AdminController@branches')->name('dashboardBranches');
    Route::get('careers', 'AdminController@careers')->name('dashboardCareers');
    Route::get('department', 'AdminController@department')->name('dashboardProductDepartment');
    Route::get('division', 'AdminController@division')->name('dashboardProductDivision');
    Route::get('departmentSub', 'AdminController@departmentSub')->name('dashboardProductDepartmentSub');

    Route::get('ajax/{table}', 'AdminController@ajaxData')->name('ajaxData');

    Route::post('db_delete','AdminController@db_delete');
    Route::post('modalEdit','AdminController@modalEdit');
    Route::post('modalAdd','AdminController@modalAdd');

    Route::post('dbedit','AdminController@editItem')->name('editItem');
    Route::post('dbadd','AdminController@addItem')->name('addItem');

});

Route::get('/test',function (){
    $products = Product::select('ctproducts.idProduct','ctproducts.details','ctproducts.imageFile','ctbrands.imageFile as brandImageFile','ctbrands.brandName','department_sub.departmentSubName')
        ->leftJoin('ctbrands','ctproducts.idBrand','=','ctbrands.idBrand')
        ->leftJoin('department_sub','ctproducts.idDepartmentSub','=','department_sub.id')
        ->orderByRaw("FIELD(ctbrands.brandName,'ABC','MASTER') DESC,ctbrands.brandName")
        ->orderByRaw("case when departmentSubName is null then 1 else 0 end, departmentSubName")
        ->where('ctproducts.isfeatured',1)->get();
//    dd($products);
    foreach ($products as $product){
        echo "<pre>";
        echo $product->brandName . " " . substr($product->details,0,-1);
        echo "</pre>";
        echo "</br>";
    }

});









