<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TopSellingController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\TrendingCategoryController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SubCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/account', [FrontController::class, 'account'])->name('account');
});


Route::middleware('IsAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/dashboard/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/dashboard/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/dashboard/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/dashboard/categories/{category}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/dashboard/categories/delete', [CategoryController::class, 'delete'])->name('categories.delete');

    //SubCategory
    Route::get('/dashboard/subcategories', [SubCategoryController::class, 'index'])->name('subcategories');
    Route::get('/dashboard/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::post('/dashboard/subcategories/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/dashboard/subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::put('/dashboard/subcategories/{subcategory}/update', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/dashboard/subcategories/delete', [SubCategoryController::class, 'delete'])->name('subcategories.delete');

    Route::get('/dashboard/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/dashboard/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/dashboard/brands/store', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/dashboard/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/dashboard/brands/{brand}/update', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/dashboard/brands/delete', [BrandController::class, 'delete'])->name('brands.delete');

    Route::get('/dashboard/vendors', [VendorController::class, 'index'])->name('vendors');
    Route::get('/dashboard/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
    Route::post('/dashboard/vendors/store', [VendorController::class, 'store'])->name('vendors.store');
    Route::get('/dashboard/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
    Route::put('/dashboard/vendors/{vendor}/update', [VendorController::class, 'update'])->name('vendors.update');
    Route::delete('/dashboard/vendors/delete', [VendorController::class, 'delete'])->name('vendors.delete');

    Route::get('/dashboard/products', [ProductController::class, 'index'])->name('products');
    Route::get('/dashboard/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/dashboard/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/dashboard/products/download', [ProductController::class, 'download'])->name('products.download');
    Route::post('/dashboard/products/upload', [ProductController::class, 'upload'])->name('products.upload');
    Route::post('/dashboard/products/addImage', [ProductController::class, 'addImage'])->name('products.addImage');
    Route::delete('/dashboard/products/delete', [ProductController::class, 'delete'])->name('products.delete');

    Route::get('/dashboard/productVariants', [ProductVariantController::class, 'index'])->name('productVariants');
    Route::get('/dashboard/productVariants/download', [ProductVariantController::class, 'download'])->name('productVariants.download');
    Route::post('/dashboard/productVariants/upload', [ProductVariantController::class, 'upload'])->name('productVariants.upload');
    Route::get('/dashboard/productVariants/create', [ProductVariantController::class, 'create'])->name('productVariants.create');
    Route::post('/dashboard/productVariants/store', [ProductVariantController::class, 'store'])->name('productVariants.store');
    Route::get('/dashboard/productVariants/{variant}/edit', [ProductVariantController::class, 'edit'])->name('productVariants.edit');
    Route::put('/dashboard/productVariants/{variant}/update', [ProductVariantController::class, 'update'])->name('productVariants.update');
    Route::delete('/dashboard/productVariants/delete', [ProductVariantController::class, 'delete'])->name('productVariants.delete');

    Route::get('/dashboard/banners', [BannerController::class, 'index'])->name('banners');
    Route::get('/dashboard/banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/dashboard/banners/store', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/dashboard/banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/dashboard/banners/{banner}/update', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/dashboard/banners/delete', [BannerController::class, 'delete'])->name('banners.delete');

    Route::get('/dashboard/trendingCategory', [TrendingCategoryController::class, 'index'])->name('trendingCategory');
    Route::get('/dashboard/trendingCategory/create', [TrendingCategoryController::class, 'create'])->name('trendingCategory.create');
    Route::post('/dashboard/trendingCategory/store', [TrendingCategoryController::class, 'store'])->name('trendingCategory.store');
    Route::get('/dashboard/trendingCategory/{category}/edit', [TrendingCategoryController::class, 'edit'])->name('trendingCategory.edit');
    Route::put('/dashboard/trendingCategory/{category}/update', [TrendingCategoryController::class, 'update'])->name('trendingCategory.update');
    Route::delete('/dashboard/trendingCategory/delete', [TrendingCategoryController::class, 'delete'])->name('trendingCategory.delete');

    Route::get('/dashboard/trendings', [TrendingController::class, 'index'])->name('trendings');
    Route::get('/dashboard/trendings/create', [TrendingController::class, 'create'])->name('trendings.create');
    Route::post('/dashboard/trendings/store', [TrendingController::class, 'store'])->name('trendings.store');
    Route::get('/dashboard/trendings/{trending}/edit', [TrendingController::class, 'edit'])->name('trendings.edit');
    Route::put('/dashboard/trendings/{trending}/update', [TrendingController::class, 'update'])->name('trendings.update');
    Route::delete('/dashboard/trendings/delete', [TrendingController::class, 'delete'])->name('trendings.delete');

    Route::get('/dashboard/topSelling', [TopSellingController::class, 'index'])->name('topSelling');
    Route::get('/dashboard/topSelling/create', [TopSellingController::class, 'create'])->name('topSelling.create');
    Route::post('/dashboard/topSelling/store', [TopSellingController::class, 'store'])->name('topSelling.store');
    Route::get('/dashboard/topSelling/{topSelling}/edit', [TopSellingController::class, 'edit'])->name('topSelling.edit');
    Route::put('/dashboard/topSelling/{topSelling}/update', [TopSellingController::class, 'update'])->name('topSelling.update');
    Route::delete('/dashboard/topSelling/delete', [TopSellingController::class, 'delete'])->name('topSelling.delete');
});


Route::get('/index', [FrontController::class, 'index'])->name('index');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/account', [FrontController::class, 'account'])->name('account');
Route::get('/{category}', [FrontController::class, 'category'])->name('category');
Route::get('/{category}/{subcategory}', [FrontController::class, 'subcategory'])->name('subcategory');
Route::get('/{category}/{subcategory}/{product}', [FrontController::class, 'product'])->name('product');
Route::redirect('/', '/index');

require __DIR__ . '/auth.php';

require __DIR__ . '/auth.php';
