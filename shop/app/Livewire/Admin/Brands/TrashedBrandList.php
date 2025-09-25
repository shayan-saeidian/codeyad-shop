<?php

namespace App\Livewire\Admin\Brands;

use App\Models\brand;
use App\Models\Category;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedBrandList extends Component
{
    use WithPagination;


    #[Computed()]
    public function brands(): Paginator
    {
        return brand::query()->onlyTrashed()->paginate(4);
    }

    #[On('hard-destroy-brand')]
    public function hardDestroyRow($brand_id)
    {
        brand::query()->withTrashed()->findOrFail($brand_id)->forceDelete();;

    }


    public function restoreRow($brand_id)
    {
        brand::query()->withTrashed()->findOrFail($brand_id)->restore();;

    }


    #[Layout('admin.master'),Title('لیست برند ها')]
    public function render():View
    {
        $brands = Brand::all();
        return view('livewire.admin.brands.trashed-brand-list');
    }

}
