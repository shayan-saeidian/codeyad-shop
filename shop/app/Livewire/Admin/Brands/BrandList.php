<?php

namespace App\Livewire\Admin\Brands;

use App\Models\brand;
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

class BrandList extends Component
{
    use WithPagination,WithFileUploads;
    #[Validate('required|unique:brands,name')]
    public $name;
    #[Validate('nullable|mimes:jpeg,jpg,png')]
    public $image;
    public $search;
    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        if ($this->image) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/brands/', $image, 'public');
        }

        brand::query()->create([
            'name' => $this->name,
            'slug' => make_slug($this->name),
            'image' => $this ->image ? $image : null,
        ]);
        session()->flash('success','برند جدید با موفقیت ایحاد شد');
        $this->reset();
    }

    public function editRow($id)
    {
        $this->editIndex = $id;
        $brand = brand::query()->findOrFail($id);
        $this->name = $brand->name;
    }
    public function updateRow(){
        if ($this->image) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/brands/', $image, 'public');
        }
        $this->validate();
        $brand = brand::query()->findOrFail($this->editIndex);
        $brand->update([
            'name' => $this->name,
            'slug' => make_slug($this->name),
            'image' => $this->image ? $image : $brand->image,
        ]);
        session()->flash('success','اطلاعات برند با موفقیت ویرایش شد');
        $this->reset();
    }
    #[Computed()]
    public function brands(): Paginator
    {
        return brand::query()->paginate(4);
    }

    #[On('destroy-brand')]
    public function destroyRow($brand_id)
    {
        brand::destroy($brand_id);

    }
    public function searchData()
    {
        $this->brands=brand::query()
            ->where('name','like','%'.$this->search.'%')
            ->paginate(4);
    }
    #[Layout('admin.master'),Title('لیست برند ها')]
    public function render():View
    {
        return view('livewire.admin.brands.brand-list');
    }
}
