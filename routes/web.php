<?php

use App\Http\Controllers\mainController;
use App\Http\Controllers\Admin\adminController;
use Illuminate\Support\Facades\Route;

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

//Home route
Route::get("/", [mainController::class, 'index'])->name("main");


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//categories route
Route::get('/categories', [mainController::class, 'categories'])->name('categories');
//single category route
Route::get('/categories/{id}', [mainController::class, 'singleCategory'])->name('singleCategories');
//product route
Route::get('/products', [mainController::class, 'products'])->name('Products');
//single product route
Route::get('/products/{id}', [mainController::class, 'singleProduct'])->name('singleProduct');


//Admin Route
Route::get("/admin", [adminController::class, "dashboard"])->name("adminDashboard");

//admin categories route
Route::get("/admin/categories", [adminController::class, "adminCategories"])->name("adminCategories");
//show edit category route
Route::get("/admin/category/{id}/edit", [adminController::class, "adminCategoryEdit"])->name("adminCategoryEdit");
//update category image edit form
Route::post("/admin/category/{id}/update/image", [adminController::class, "adminUpdateCategoryImage"])->name("adminUpdateCategoryImage");
//update catefory form
Route::post("/admin/category/{id}/update", [adminController::class, "adminUpdateCategory"])->name("adminUpdateCategory");
//show add category form 
Route::get("/admin/category/add", [adminController::class, "adminAddCategory"])->name("adminAddCategory");
//add category to database
Route::post("/admin/category/addtodb", [adminController::class, "adminAddCategoryToDB"])->name("adminAddCategoryToDB");
//admin delete category
Route::get("/admin/category/{id}/delete", [adminController::class, "adminDeleteCategory"])->name("adminDeleteCategory");

//show products route
Route::get("/admin/products", [adminController::class, "adminProducts"])->name("adminProducts");
//show edit Products form
Route::get("/admin/product/{id}/edit", [adminController::class, "adminEditProduct"])->name("adminEditProduct");
//update product image
Route::post("/admin/product/{id}/update/image", [adminController::class, "adminUpdateProductImage"])->name("adminUpdateProductImage");
//update product
Route::post("/admin/product/{id}/update", [adminController::class, "adminUpdateProduct"])->name("adminUpdateProduct");
//delete product
Route::get("/admin/product/{id}/delete", [adminController::class, "adminDeleteProduct"])->name("adminDeleteProduct");
//show add product form
Route::get("/admin/product/add", [adminController::class, "adminAddProduct"])->name("adminAddProduct");
//add product to db
Route::post("/admin/product/addtodb", [adminController::class, "adminAddProductToDB"])->name("adminAddProductToDB");

//admin show Users
route::get("/admin/users", [adminController::class, "showUsers"])->name("showUsers");

