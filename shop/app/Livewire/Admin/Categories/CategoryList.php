<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryList extends Component
{
    use WithPagination,WithFileUploads;
    #[Validate('required|unique:categories,name')]
    public $name;
    #[Validate('nullable|mimes:jpeg,jpg,png')]
    public $image;
    public $parent_id;
    public $search;


    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        if ($this->image) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/categories/', $image, 'public');
        }

        category::query()->create([
            'name' => $this->name,
            'slug' => make_slug($this->name),
            'image' => $this ->image ? $image : null,
            'parent_id' => $this->parent_id,
        ]);
        session()->flash('success','دسته بندی جدید با موفقیت ایحاد شد');
        $this->reset();
    }

    public function editRow($id)
    {
        $this->editIndex = $id;
        $category = Category::query()->findOrFail($id);
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;


    }
    public function updateRow(){
        if ($this->image) {
            $image = $this->image->hashName();
            $this->image->storeAs('images/categories/', $image, 'public');
        }
        $this->validate();
        $category = Category::query()->findOrFail($this->editIndex);
        $category->update([
            'name' => $this->name,
            'slug' => make_slug($this->name),
            'image' => $this->image ? $image : $category->image,
            'parent_id' => $this->parent_id,
        ]);
        session()->flash('success','اطلاعات دسته بندی با موفقیت ویرایش شد');
        $this->reset();
    }
    #[Computed()]
    public function categories(): Paginator
    {
        return Category::query()->with('parentCategory')->paginate(4);
    }

    #[On('destroy-category')]
    public function destroyRow($category_id)
    {
        Category::destroy($category_id);

    }
    public function searchData()
    {
        $this->categories=Category::query()
            ->where('name','like','%'.$this->search.'%')
            ->with('parentCategory')->paginate(4);
    }
    #[Layout('admin.master'),Title('لیست دسته بندی ها')]
    public function render():View
    {
        $categories = Category::getCategories();
        return view('livewire.admin.categories.category-list',compact('categories'));
    }

}
