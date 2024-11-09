<?php

namespace App\Livewire;

use App\Http\Middleware\PositionMiddleware;
use App\Models\Position;
use App\Models\PositionPermission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserView extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $isRole = '';
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';
    public $userEditID;
    public $userName,
        $userEmail,
        $userPassword,
        $userStatus,
        $userRole;
    public $userDeleteID;

    public $isOpen = false;
    public $isDeleteModalOpen = false;
    public $isAddModalOpen = false;

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == "ASC") ? $this->sortDir = "DESC" : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function resetFields()
    {
        $this->search = '';
        $this->perPage = 5;
        $this->isRole = '';
        $this->sortBy = 'created_at';
        $this->sortDir = 'DESC';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function closeDeleteModal()
    {
        $this->isDeleteModalOpen = false;
        $this->userDeleteID = '';
    }
    public function openDeleteModal($userID)
    {
        $this->isDeleteModalOpen = true;
        $this->userDeleteID = $userID;
    }

    public function openAddModal()
    {
        $this->isAddModalOpen = true;
    }

    public function closeAddModal()
    {
        $this->isAddModalOpen = false;
        $this->reset('userName', 'userEmail', 'userStatus', 'userPassword', 'userRole');
    }

    

    public function delete()
    {
        $permission = PositionPermission::getPermission('delete user', Auth::user()->position_id);
        if ($permission) {
            $user = User::findOrFail($this->userDeleteID);
            $user->delete();
            $this->closeDeleteModal();
            request()->session()->flash('failure', 'User deleted !');
        } else {
            abort(404);
        }
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset('userName', 'userEmail', 'userStatus', 'userPassword', 'userRole');
    }

    public function edit($userID)
    {
        $permission = PositionPermission::getPermission('update user', Auth::user()->position_id);
        if ($permission) {
            $this->isOpen = true;
            $this->userEditID = $userID;
            $this->userName = User::findOrFail($userID)->name;
            $this->userEmail = User::findOrFail($userID)->email;
            $this->userStatus = User::findOrFail($userID)->status;
            $this->userRole = User::findOrFail($userID)->position_id;
        } else {
            abort(404);
        }
    }

    public function update()
    {
        $permission = PositionPermission::getPermission('update user', Auth::user()->position_id);
        if ($permission) {
            $this->validate(
                [
                    'userName' => ['required'],
                    'userEmail' => ['required'],
                    'userStatus' => ['required'],
                    'userRole' => ['required'],
                ]
            );

            User::findOrFail($this->userEditID)->update(
                [
                    'name' =>  $this->userName,
                    'email' =>  $this->userEmail,
                    'status'  => $this->userStatus,
                    'position_id'  => $this->userRole,
                ]
            );
            $this->closeModal();
            request()->session()->flash('success', 'User updated successfully');
        } else {
            abort(404);
        }
    }

    public function add()
    {
        $permission = PositionPermission::getPermission('update user', Auth::user()->position_id);
        if ($permission) {
            $this->validate(
                [
                    'userName' => ['required'],
                    'userEmail' => ['required'],
                    'userStatus' => ['required'],
                    'userPassword' => ['required', 'confirmed', Password::min(6)],
                    'userRole' => ['required'],
                ]
            );

            User::create(
    [
                    'name' =>  $this->userName,
                    'email' =>  $this->userEmail,
                    'status'  => $this->userStatus,
                    'password'  => Hash::make($this->userPassword),
                    'position_id'  => $this->userRole,
                ]
            );
            $this->closeAddModal();
            request()->session()->flash('success', 'User created successfully');
        } else {
            abort(404);
        }
    }

    public function render()
    {
        $usersWithPosition = DB::table('users')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.*', 'positions.name as position')
            ->paginate($this->perPage);
        //dd($usersWithPosition);
        //$users = User::latest()->with(['employer', 'positions'])->paginate($this->perPage);
        return view('livewire.user-view', [
            'users' => $usersWithPosition
        ]);
    }
}
