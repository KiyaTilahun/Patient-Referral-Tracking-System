<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserEdit extends Component
{

    // public $user;
    // public $userId;

    // public function mount($userId)
    // {
    //     dd($userId);
    //     $this->userId = $userId;
    //     $this->user = User::findOrFail($userId);
    // }
    public $userId;

    // public function __construct($userId)
    // {
    //     $this->userId = $userId;
    // }
    public function render()
    {
        return view('livewire.admin.users.user-edit');
    }
}
