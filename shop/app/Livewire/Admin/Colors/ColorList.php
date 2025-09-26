<?php

namespace App\Livewire\Admin\Colors;

use App\Models\color;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ColorList extends Component
{
    use WithPagination,WithFileUploads;
    #[Validate('required|unique:colors,name')]
    public $name;
    #[Validate('required|unique:colors,code')]
    public $code;

    public $search;
    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        Color::query()->create([
            'name' => $this->name,
            'code' => $this->code,
        ]);
        session()->flash('success','رنگ جدید با موفقیت ایحاد شد');
        $this->reset();
    }

    public function editRow($id)
    {
        $this->editIndex = $id;
        $color = color::query()->findOrFail($id);
        $this->name = $color->name;
        $this->code = $color->code;
    }
    public function updateRow(){
        $this->validate();
        $color = color::query()->findOrFail($this->editIndex);
        $color->update([
            'name' => $this->name,
            'code' => $this->code,

        ]);
        session()->flash('success','اطلاعات رنگ با موفقیت ویرایش شد');
        $this->reset();
    }
    #[Computed()]
    public function colors(): Paginator
    {
        return color::query()->paginate(4);
    }

    #[On('destroy-color')]
    public function destroyRow($color_id)
    {
        color::destroy($color_id);

    }
    public function searchData()
    {
        $this->colors=color::query()
            ->where('name','like','%'.$this->search.'%')
            ->paginate(4);
    }
    #[Layout('admin.master'),Title('لیست رنگ ها')]
    public function render()
    {
        return view('livewire.admin.colors.color-list');
    }
}
