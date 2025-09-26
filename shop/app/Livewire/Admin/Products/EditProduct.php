<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;

    public $name;

    public $e_name;

    public $price;
    public $discount,$count,$max_sell;

    public $description;

    public $category_id;

    public $brand_id;

    public $image;
    public $product_image;
    public $editIndex;
    public $product;

    public function mount(Product $product){
        $this->product = $product;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->discount = $product->discount;
        $this->count = $product->count;
        $this->e_name = $product->e_name;
        $this->max_sell=$product->max_sell;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->product_image = $product->image;
    }


    public function updateRow(){
        if ($this->image instanceof TemporaryUploadedFile) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/products/', $image, 'public');
        } else {
            $image = $this->product->image; // اگر عکس جدید نیومده، قبلی رو نگه دار
        }

        $this->validate([
            'name' => 'required|unique:products,name,'.$this->product->id,
            'e_name' => 'required|unique:products,e_name,'.$this->product->id,
            'price' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',

        ]);
        $product = Product::query()->findOrFail($this->product->id);
        $product->update([
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
        ]);
        session()->flash('success','اطلاعات محضول با موفقیت ویرایش شد');
        $this->reset();
    }
    #[Layout('admin.master'),Title('ویرایش محصول')]
    public function render()
    {
        $categories = Category::query()
            ->where('parent_id', '!=',null)
            ->pluck('name', 'id');

        $brands = Brand::query()
            ->pluck('name', 'id');
         return view('livewire.admin.products.edit-product',compact('categories','brands'));
    }
}
