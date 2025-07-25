<?php

namespace App\Livewire\Accounting\Dashboard;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Accounting\AbAccountType;

class AccountingAccountTypeList extends Component
{
    public $abAccountTypes;

    public function render(): View
    {
        $this->abAccountTypes = AbAccountType::all();

        return view('livewire.accounting.dashboard.accounting-account-type-list');
    }
}
