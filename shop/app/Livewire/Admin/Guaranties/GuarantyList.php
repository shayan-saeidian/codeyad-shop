<?php

namespace App\Livewire\Admin\Guaranties;

use App\Models\guaranty;
use Illuminate\Contracts\Pagination\Paginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class GuarantyList extends Component
{
    use WithPagination,WithFileUploads;
    #[Validate('required|unique:guaranties,name')]
    public $name;

    public $search;
    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        Guaranty::query()->create([
            'name' => $this->name,
        ]);
        session()->flash('success','گارانتی جدید با موفقیت ایحاد شد');
        $this->reset();
    }

    public function editRow($id)
    {
        $this->editIndex = $id;
        $guaranty = Guaranty::query()->findOrFail($id);
        $this->name = $guaranty->name;
    }
    public function updateRow(){
        $this->validate();
        $guaranty = Guaranty::query()->findOrFail($this->editIndex);
        $guaranty->update([
            'name' => $this->name,
        ]);
        session()->flash('success','اطلاعات گارانتی با موفقیت ویرایش شد');
        $this->reset();
    }
    #[Computed()]
    public function guaranties(): Paginator
    {
        return Guaranty::query()->paginate(4);
    }

    #[On('destroy-guaranty')]
    public function destroyRow($guaranty_id)
    {
        Guaranty::destroy($guaranty_id);

    }
    public function searchData()
    {
        $this->guaranties=Guaranty::query()
            ->where('name','like','%'.$this->search.'%')
            ->paginate(4);
    }
    #[Layout('admin.master'),Title('لیست گارانتی ها')]
    public function render()
    {
        return view('livewire.admin.guaranties.guaranty-list');
    }
}
