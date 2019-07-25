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
//Dashboard Route Start
Route::get('/','Admin\Dashboard\DashboardController@index')->name('admin_dashboard');
//Dashboard Route End

//Auth Routes Start
Route::get('admin/sign-in','Admin\Auth\AuthController@sign_in')->name('admin_signin');
Route::post('admin/validate-credentials','Admin\Auth\AuthController@validating_credentials')->name('validating_credentials');
Route::any('admin/sign-out','Admin\Auth\AuthController@admin_logout')->name('admin_logout');
//Auth Routes End

//Packages Routes Start
//Categories Routes Start
Route::get('admin/package/categories','Admin\Package\PackageCategoriesController@index')->name('package_categories');
Route::get('admin/package/categories/add','Admin\Package\PackageCategoriesController@add')->name('package_categories_add');
Route::post('admin/package/categories/insert','Admin\Package\PackageCategoriesController@insert')->name('package_categories_insert');
Route::get('admin/package/categories/edit/{id}','Admin\Package\PackageCategoriesController@edit')->name('package_categories_edit');
Route::post('admin/package/categories/update/{id}','Admin\Package\PackageCategoriesController@update')->name('package_categories_update');
Route::post('admin/package/categories/delete/{id}','Admin\Package\PackageCategoriesController@delete')->name('package_categories_delete');
Route::get('admin/package/categories/search','Admin\Package\PackageCategoriesController@filter_package_categories')->name('package_categories_filter');
Route::any('admin/package/categories/update-status/{id}','Admin\Package\PackageCategoriesController@update_status')->name('update_status');
//Categories Routes End

//Packages Routes Start
Route::get('admin/packages/','Admin\Package\PackagesController@index')->name('packages');
Route::get('admin/packages/add','Admin\Package\PackagesController@add')->name('packages_add');
Route::post('admin/package/insert','Admin\Package\PackagesController@insert')->name('packages_insert');
Route::get('admin/packages/edit/{id}','Admin\Package\PackagesController@edit')->name('packages_edit');
Route::post('admin/packages/update/{id}','Admin\Package\PackagesController@update')->name('packages_update');
Route::post('admin/packages/delete/{id}','Admin\Package\PackagesController@delete')->name('packages_delete');
Route::get('admin/packages/search','Admin\Package\PackagesController@filter_packages')->name('packages_filter');
Route::any('admin/package/update-status/{id}','Admin\Package\PackagesController@update_status')->name('update_packages_status');
// Route::get('admin/packages/check-name','Admin\Package\PackagesController@check_name');
//Packages Routes End
//Packages Routes End

//Portfolio Routes Start
//Categories Routes Start
Route::get('admin/portfolio/categories','Admin\Portfolio\CategoriesController@index')->name('portfolio_categories');
Route::get('admin/portfolio/categories/add','Admin\Portfolio\CategoriesController@add')->name('portfolio_categories_add');
Route::post('admin/portfolio/categories/insert','Admin\Portfolio\CategoriesController@insert')->name('portfolio_categories_insert');
Route::get('admin/portfolio/categories/edit/{id}','Admin\Portfolio\CategoriesController@edit')->name('portfolio_categories_edit');
Route::post('admin/portfolio/categories/update/{id}','Admin\Portfolio\CategoriesController@update')->name('portfolio_categories_update');
Route::post('admin/portfolio/categories/delete/{id}','Admin\Portfolio\CategoriesController@delete')->name('portfolio_categories_delete');
Route::get('admin/portfolio/categories/search','Admin\Portfolio\CategoriesController@filter_portfolio_categories')->name('portfolio_categories_filter');
Route::any('admin/portfolio/categories/update-status/{id}','Admin\Portfolio\CategoriesController@update_status')->name('update_status');
//Categories Routes End
//Portfolio Routes Start
Route::get('admin/portfolio/','Admin\Portfolio\PortfolioController@index')->name('portfolio');
Route::get('admin/portfolio/add/','Admin\Portfolio\PortfolioController@add')->name('portfolio_add');
Route::post('admin/portfolio/insert/','Admin\Portfolio\PortfolioController@insert')->name('portfolio_insert');
Route::get('admin/portfolio/edit/{id}','Admin\Portfolio\PortfolioController@edit')->name('portfolio_edit');
Route::post('admin/portfolio/update/{id}','Admin\Portfolio\PortfolioController@update')->name('portfolio_update');
Route::post('admin/portfolio/delete/{id}','Admin\Portfolio\PortfolioController@delete')->name('portfolio_delete');
Route::get('admin/portfolio/search/','Admin\Portfolio\PortfolioController@filter_portfolio')->name('filter_portfolio');
Route::post('admin/portfolio/update-status/{id}','Admin\Portfolio\PortfolioController@update_portfolio_status')->name('update_portfolio_status');
//Portfolio Routes End
//Portfolio Routes End

//Advertisement Routes Start
//Banners Routes Start
Route::get('admin/advertisement/banners','Admin\Advertisement\BannersController@index')->name('banners');
Route::get('admin/advertisement/banners/add','Admin\Advertisement\BannersController@add')->name('banners_add');
//Banners Routes End
//Advertisement Routes End
