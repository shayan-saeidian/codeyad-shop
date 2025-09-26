<?php

use App\Livewire\Admin\Brands\BrandList;
use App\Livewire\Admin\Brands\TrashedBrandList;
use App\Livewire\Admin\Categories\CategoryList;
use App\Livewire\Admin\Categories\TrashedCategoryList;
use App\Livewire\Admin\Colors\ColorList;
use App\Livewire\Admin\Colors\TrashedColorList;
use App\Livewire\Admin\Panel;
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
