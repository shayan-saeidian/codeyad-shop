<?php

namespace App\Livewire\Admin\Products;

use App\Enums\ProductStatus;
use App\Models\Brand;
use App\Models\Category;
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
    #[Validate('required|mimes:jpeg,jpg,png')]
    public $image;
    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        if ($this->image) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/products/', $image, 'public');
        }

        Product::query()->create([
            'name' => $this->name,
            'slug' => make_slug($this->name),
            'image' => $image,
            'e_name' => $this->e_name,
            'price' => $this->price,
            'discount' => $this->discount,
            'count' => $this->count,
            'max_sell' => $this->max_sell,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'status' => ProductStatus::Active->value,

        ]);
        session()->flash('success','محصول جدید با موفقیت ایحاد شد');
        $this->reset();
        $this->redirectRoute('admin.products.list');
    }


    #[Computed()]
    public function products(): Paginator
    {
        return product::query()->paginate(4);
    }


    #[Layout('admin.master'),Title('ایجاد محصول')]
    public function render():View
    {
        $categories = Category::query()
            ->where('parent_id', '!=',null)
            ->pluck('name', 'id');

        $brands = Brand::query()
            ->pluck('name', 'id');
        return view('livewire.admin.products.create-product',compact('categories','brands'));
    }
}
