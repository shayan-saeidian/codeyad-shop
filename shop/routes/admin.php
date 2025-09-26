<?php

use App\Livewire\Admin\Brands\BrandList;
use App\Livewire\Admin\Brands\TrashedBrandList;
use App\Livewire\Admin\Categories\CategoryList;
use App\Livewire\Admin\Categories\TrashedCategoryList;
use App\Livewire\Admin\Colors\ColorList;
use App\Livewire\Admin\Colors\TrashedColorList;
use App\Livewire\Admin\Guaranties\GuarantyList;
use App\Livewire\Admin\Guaranties\TrashedGuarantyList;
use App\Livewire\Admin\Panel;
use App\Livewire\Admin\Products\CreateProduct;
use App\Livewire\Admin\Products\EditProduct;
use App\Livewire\Admin\Products\ProductList;
use App\Livewire\Admin\Products\TrashedProductList;
use App\Livewire\Admin\Users\UserList;
use Illuminate\Support\Facades\Route;


Route::get('/', Panel::class)->name('panel');
//users
Route::get('/users', UserList::class)->name('admin.users.list');
//categories
Route::get('/categories', CategoryList::class)->name('admin.categories.list');
Route::get('/trashed_categories', TrashedCategoryList::class)->name('admin.trashed_categories.list');
//brands
Route::get('/brands', BrandList::class)->name('admin.brands.list');
Route::get('/trashed_brands', TrashedBrandList::class)->name('admin.trashed_brands.list');
//colors
Route::get('/colors', ColorList::class)->name('admin.colors.list');
Route::get('/trashed_colors', TrashedColorList::class)->name('admin.trashed_colors.list');
//guaranties
Route::get('/guaranties', GuarantyList::class)->name('admin.guaranties.list');
Route::get('/trashed_guaranties', TrashedGuarantyList::class)->name('admin.trashed_guaranties.list');
//products
Route::get('/products', ProductList::class)->name('admin.products.list');
Route::get('/trashed_products', TrashedProductList::class)->name('admin.trashed_products.list');
Route::get('/create_product', CreateProduct::class)->name('admin.create.product');
Route::get('/edit_product/{product}', EditProduct::class)->name('admin.edit.product');
