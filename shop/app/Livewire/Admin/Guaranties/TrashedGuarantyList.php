<?php

namespace App\Livewire\Admin\Guaranties;

use App\Models\guaranty;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedGuarantyList extends Component
{
    use WithPagination;


    #[Computed()]
    public function guaranties(): Paginator
    {
        return guaranty::query()->onlyTrashed()->paginate(4);
    }

    #[On('hard-destroy-guaranty')]
    public function hardDestroyRow($guaranty_id)
    {
        guaranty::query()->withTrashed()->findOrFail($guaranty_id)->forceDelete();;

    }


    public function restoreRow($guaranty_id)
    {
        guaranty::query()->withTrashed()->findOrFail($guaranty_id)->restore();;

    }


    #[Layout('admin.master'),Title('لیست گارانتی ها')]
    public function render():View
    {
        $guaranty = guaranty::all();
        return view('livewire.admin.guaranties.trashed-guaranty-list');
    }

}
