<?php

namespace App\Livewire\UserGroup\Dashboard;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Traits\ModesTrait;
use App\UserGroup;

class UserGroupList extends Component
{
    use WithPagination;
    use ModesTrait;

    protected $paginationTheme = 'bootstrap';

    public $userGroups;
    public $userGroupCount;
    public $deletingUserGroup;

    public $modes = [
        'delete' => false,
    ];

    public function render(): View
    {
        $this->userGroups = UserGroup::all();
        $this->userGroupCount = UserGroup::count();

        return view('livewire.user-group.dashboard.user-group-list');
    }
}
