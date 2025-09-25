<?php

namespace App\Livewire\Admin\Users;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;


class UserList extends Component
{
    use WithPagination;
    #[Validate('required')]
    public $name;
    #[Validate('nullable|unique:users,email')]
    public $email;
    #[Validate('nullable|unique:users,mobile')]
    public $mobile;
    #[Validate('required|min:6')]
    public $password;
    public $search;
    public $editIndex;

    public function createRow(): void
    {
        $this->validate();
        User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => Hash::make($this->password),
        ]);
        session()->flash('success','کاربر جدید با موفقیت ایحاد شد');
        $this->reset();
    }

    public function editRow($id)
    {
        $this->editIndex = $id;
        $user = User::query()->findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;


    }
    public function updateRow(){
        $this->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$this->editIndex,
            'mobile'=>'required|unique:users,mobile,'.$this->editIndex,

        ]);
        $user = User::query()->findOrFail($this->editIndex);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);
        session()->flash('success','اطلاعات کاربر با موفقیت ویرایش شد');
        $this->reset();
    }
    #[Computed()]
    public function users(): Paginator
    {
        return User::query()->paginate(1);
    }
    #[Layout('admin.master'),Title('لیست کاربران')]
    public function render():View
    {
        return view('livewire.admin.users.user-list');
    }
    public function searchData()
    {
        $this->users=User::query()
            ->where('name','like','%'.$this->search.'%')
            ->paginate(4);
    }
}
