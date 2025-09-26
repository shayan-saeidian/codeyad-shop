<?php

namespace App\Livewire\Admin\Colors;

use App\Models\color;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedColorList extends Component
{
    use WithPagination;


    #[Computed()]
    public function colors(): Paginator
    {
        return color::query()->onlyTrashed()->paginate(4);
    }

    #[On('hard-destroy-color')]
    public function hardDestroyRow($color_id)
    {
        color::query()->withTrashed()->findOrFail($color_id)->forceDelete();;

    }


    public function restoreRow($color_id)
    {
        color::query()->withTrashed()->findOrFail($color_id)->restore();;

    }


    #[Layout('admin.master'),Title('لیست رنگ ها')]
    public function render():View
    {
        $color = Color::all();
        return view('livewire.admin.colors.trashed-color-list');
    }

}
