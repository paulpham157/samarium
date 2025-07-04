<?php

namespace App\Livewire\CafeSale\Dashboard;

use Livewire\Component;
use Illuminate\View\View;
use App\Traits\ModesTrait;
use App\Models\SeatTable\SeatTable;

class CafeSaleComponent extends Component
{
    use ModesTrait;

    public ?SeatTable $workingSeatTable = null;
    public ?SeatTable $displayingSeatTable = null;

    public $modes = [
        'workingTableDisplay' => false,
        'createSeatTableMode' => false,
        'seatTableDisplayXypher' => false,
        'editSettingsMode' => false,
    ];

    protected $listeners = [
        'displayWorkingSeatTable',
        'seatTableCreateCompleted',
        'seatTableCreateCancelled',
        'displaySeatTableXypher',
        'exitSaleInvoiceWorkMode',
    ];

    public function render(): View
    {
        return view('livewire.cafe-sale.dashboard.cafe-sale-component');
    }

    public function displayWorkingSeatTable($seat_table_id): void
    {
        $seatTable = SeatTable::findOrFail($seat_table_id);

        $this->workingSeatTable = $seatTable;
        $this->enterMode('workingTableDisplay');
    }

    public function seatTableCreateCompleted(): void
    {
        $this->exitMode('createSeatTableMode');
    }

    public function seatTableCreateCancelled(): void
    {
        $this->exitMode('createSeatTableMode');
    }

    public function  displaySeatTableXypher($seat_table_id): void
    {
        $seatTable = SeatTable::findOrFail($seat_table_id);

        $this->displayingSeatTable = $seatTable;
        $this->enterMode('seatTableDisplayXypher');
    }

    public function exitSaleInvoiceWorkMode(): void
    {
        $this->displayingSaleInvoice = null;
        $this->clearModes();
    }
}
