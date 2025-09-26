<?php

namespace App\Livewire\Admin\Products;

use App\Models\product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public $search;
    public $editIndex;

    #[Computed()]
    public function products(): Paginator
    {
        return product::query()
            ->with('category','brand')
            ->paginate(5);
    }

    #[On('destroy-product')]
    public function destroyRow($product_id)
    {
        product::destroy($product_id);

    }
    public function searchData()
    {
        $this->products=product::query()
            ->where('name','like','%'.$this->search.'%')
            ->with('category','brand')
            ->paginate(4);
    }
    #[Layout('admin.master'),Title('لیست محصولات')]
    public function render():View
    {
        $products = product::all();
        return view('livewire.admin.products.product-list',compact('products'));
    }

}
