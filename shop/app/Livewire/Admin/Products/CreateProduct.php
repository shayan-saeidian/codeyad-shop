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

class CreateProduct extends Component
{

    use WithFileUploads;
    #[Validate('required|unique:products,name')]
    public $name;
    #[Validate('required|unique:products,e_name')]
    public $e_name;
    #[Validate('required')]
    public $price;
    public $discount,$count,$max_sell;
    #[Validate('required')]
    public $description;
    #[Validate('required')]
    public $category_id;
    #[Validate('required')]
    public $brand_id;
    #[Validate('required')];
    #[Validate('nullable|mimes:jpeg,jpg,png')]
    public $image;
    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        if ($this->image) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/products/', $image, 'public');
        }

        product::query()->create([
            'name' => $this->name,
            'slug' => make_slug($this->name),
            'image' => $this ->image ? $image : null,
            'parent_id' => $this->parent_id,
        ]);
        session()->flash('success','محصول جدید با موفقیت ایحاد شد');
        $this->reset();
    }


    #[Computed()]
    public function products(): Paginator
    {
        return product::query()->paginate(4);
    }


    #[Layout('admin.master'),Title('ایجاد محصول')]
    public function render():View
    {
        $products = product::getproducts();
        return view('livewire.admin.products.create-product',compact('products'));
    }
}
