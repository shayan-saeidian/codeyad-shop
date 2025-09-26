<?php

namespace App\Livewire\Admin\Products;

use App\Models\product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedProductList extends Component
{
    use WithPagination;


    #[Computed()]
    public function products(): Paginator
    {
        return Product::query()->onlyTrashed()->paginate(4);
    }

    #[On('hard-destroy-product')]
    public function hardDestroyRow($product_id)
    {
        Product::query()->withTrashed()->findOrFail($product_id)->forceDelete();;

    }


    public function restoreRow($product_id)
    {
        Product::query()->withTrashed()->findOrFail($product_id)->restore();;

    }


    #[Layout('admin.master'),Title('لیست محصول ها')]
    public function render():View
    {
        $products = Product::all();
        return view('livewire.admin.products.trashed-product-list');
    }

}
