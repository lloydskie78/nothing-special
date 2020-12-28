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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'PublicController@index')->name('main');
// Route::get('/home', 'PublicController@index')->name('main');
Route::get('/about', 'PublicController@about')->name('about');
Route::get('/products', 'PublicController@products')->name('products');
Route::get('/featured', 'PublicController@featuredProducts')->name('featured');
Route::get('/branches', 'PublicController@branches')->name('branches');
Route::get('/careers', 'PublicController@careers')->name('careers');
Route::get('/news', 'PublicController@newsAndUpdates')->name('news');
Route::get('/branch/{id}', 'PublicController@branch')->name('branch');
// Route::get('product/category/{id}', 'PublicController@productPerCat')->name('productPerCat');
// Route::get('product/category/{department}', 'PublicController@productPerCat')->name('productPerCat');
Route::get('products/{category}/{department}', 'PublicController@productPerCat')->name('productPerCat');
Route::get('products/category/{departmentId}/{subDepartmentId}', 'PublicController@productPerCatAndSubCat')->name('productPerCatAndSubCat');

Route::get('/eproducts', 'PublicController@eproducts')->name('eproducts');
Route::get('/index_test', 'PublicController@index_test')->name('index_test');

Route::get('/productprofile/{id}', 'PublicController@productprofile')->name('productprofile');

Route::post('/jobcathandler', 'PublicController@careersAjax');
Route::get('/jobcathandler', 'PublicController@careersAjax');

Route::post('/getBranch', 'PublicController@getcareeerBranch');
Route::post('/getbranchEmail', 'PublicController@getcareerbranchEmail');

Route::post('/producthandler', 'PublicController@productsAjax');
Route::get('/producthandler', 'PublicController@productsAjax');
Route::post('/productSearch', 'PublicController@productSearch');

Route::post('{url}', 'PublicController@modalAjax')->where(['url' => 'modalhandler']);

Route::post('/sendmail', 'PublicController@emailSumbit');
Route::get('branch_tooltip', 'PublicController@LOAD_TOOLTIP');

// Route::any('{slug}', function () {
//     return view('errors.404');
// });

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
    Route::get('productarchive', 'AdminController@productarchive')->name('dashboardProductArchive');
    Route::get('banner', 'AdminController@banner')->name('dashboardbanner');
    Route::get('link', 'AdminController@link')->name('dashboardlink');
    Route::get('branch_api', 'AdminController@BRANCH_API');

    Route::get('ajax/{table}', 'AdminController@ajaxData')->name('ajaxData');

    // Route::get('ajax/{table}', 'AdminController@')->name('ajaxData');

    //show modal
    Route::post('modalEdit', 'AdminController@modalEdit');
    Route::post('modalAdd', 'AdminController@modalAdd');

    Route::post('dbedit', 'AdminController@editItem')->name('editItem');
    Route::post('dbadd', 'AdminController@addItem')->name('addItem');
    Route::post('db_delete', 'AdminController@db_delete');
    Route::post('db_restore', 'AdminController@db_restore');
    Route::post('db_harddelete', 'AdminController@db_harddelete');

    Route::post('modalMap', 'AdminController@modalMap');
    Route::post('modalSetmap', 'AdminController@setMap');
    Route::post('setxy', 'AdminController@setXY');
    Route::post('setTooltip', 'AdminController@SAVE_TOOLTIP');
    Route::post('image-upload', 'AdminController@imageUploadPost')->name('image.upload.post');
});
