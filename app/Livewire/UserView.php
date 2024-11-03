<?php

namespace App\Livewire;

use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

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

    public function delete()
    {
        $user = User::findOrFail($this->userDeleteID);
        $user->delete();
        $this->closeDeleteModal();
        request()->session()->flash('failure', 'User deleted !');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset('userName', 'userEmail', 'userPassword', 'userRole');
    }


    public function edit($userID)
    {
        $this->isOpen = true;
        $this->userEditID = $userID;
        $this->userName = User::findOrFail($userID)->name;
        $this->userEmail = User::findOrFail($userID)->email;
        $this->userPassword = User::findOrFail($userID)->password;
        $this->userRole = User::findOrFail($userID)->role;
        $this->userStatus = User::findOrFail($userID)->status;
    }

    public function update()
    {
        $this->validate(
            [
                'userName' => ['required'],
                'userEmail' => ['required'],
                'userPassword' => ['required'],
                'userRole' => ['required'],
                'userStatus' => ['required']
            ]
        );

        User::findOrFail($this->userEditID)->update(
            [
                'name' =>  $this->userName,
                'email' =>  $this->userEmail,
                'password' =>           $this->userPassword,
                'status'  =>          $this->userStatus,
            ]
        );

        Position::where('user_id', $this->userEditID)->update(
            ['role_id' => $this->userRole]
        );

        $this->closeModal();
        request()->session()->flash('success', 'User updated successfully');
    }

    public function render()
    {
        $usersWithPosition = DB::table('users')
            ->join('position_user', 'users.id', '=', 'position_user.user_id')
            ->join('positions', 'positions.id', '=', 'position_user.position_id')
            ->select('users.*', 'positions.name as position')
            ->paginate($this->perPage);
        //dd($usersWithPosition);
        //$users = User::latest()->with(['employer', 'positions'])->paginate($this->perPage);
        return view('livewire.user-view', [
            'users' => $usersWithPosition
        ]);
    }
}
