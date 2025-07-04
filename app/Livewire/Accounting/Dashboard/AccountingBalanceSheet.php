<?php

namespace App\Livewire\Accounting\Dashboard;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Accounting\AbAccountType;
use App\Models\Accounting\AbAccount;

class AccountingBalanceSheet extends Component
{
    public $assetTotal;
    public $liabilityTotal;
    public $equityTotal;

    /* This taken from income statement to calculate retained earnings. */
    public $revenueItems = array();
    public $cogsItems = array();
    public $expenseItems = array();

    public $revenueTotal;
    public $cogsTotal;
    public $expenseTotal;

    public $grossProfit;
    public $netProfit;
    /* This taken from income statement to calculate retained earnings. */

    public function render(): View
    {
        $this->calculateAssetTotal();
        $this->calculateLiabilitiesTotal();
        $this->calculateEquityTotal();

        return view('livewire.accounting.dashboard.accounting-balance-sheet');
    }

    public function calculateAssetTotal(): void
    {
        $total = 0;

        $assetAccountType = AbAccountType::where('name', 'Asset')->first();

        foreach ($assetAccountType->abAccounts as $abAccount) {
            $total += $abAccount->getLedgerBalance();
        }

        $this->assetTotal = $total;
    }

    public function calculateLiabilitiesTotal(): void
    {
        $total = 0;

        $liabilitiesAccountType = AbAccountType::where('name', 'Liabilities')->first();

        foreach ($liabilitiesAccountType->abAccounts as $abAccount) {
            $total += $abAccount->getLedgerBalance();
        }

        $this->liabilityTotal = $total;
    }

    public function calculateEquityTotal(): void
    {
        /* TODO: 
         *
         * Here, in balance sheet, we again do whatever we did in the
         * income statement generation, because we need the retained
         * earnings total to add to get equity total. 
         *
         * Any way not to repeat whatever has been done while generating
         * income statement?
         *
         */

        $total = 0;

        $liabilitiesAccountType = AbAccountType::where('name', 'Equity')->first();

        foreach ($liabilitiesAccountType->abAccounts as $abAccount) {
            $total += $abAccount->getLedgerBalance();
        }

        /* Calculate net income/profit */
        $this->populateRevenue();
        $this->populateCogs();
        $this->populateExpense();

        $this->calculateGrossProfit();
        $this->calculateNetProfit();

        $total += $this->netProfit;

        $this->equityTotal = $total;
    }

    /* This taken from income statement to calculate retained earnings. */
    public function populateRevenue(): void
    {
        $total = 0;

        $salesAbAccount = AbAccount::where('name', 'sales')->first();

        $salesRevenue['name'] = 'Sales';
        $salesRevenue['amount'] = $salesAbAccount->getLedgerBalance() * -1;

        $this->revenueTotal = $salesRevenue['amount'];

        $this->revenueItems[] = $salesRevenue;
    }

    public function populateCogs(): void
    {
        $purchaseAbAccount = AbAccount::where('name', 'purchase')->first();

        $purchaseCogs['name'] = 'Purchase';
        $purchaseCogs['amount'] = $purchaseAbAccount->getLedgerBalance();

        $this->cogsTotal = $purchaseCogs['amount'];

        $this->cogsItems[] = $purchaseCogs;
    }

    public function populateExpense(): void
    {
        $expenseAbAccount = AbAccount::where('name', 'expense')->first();

        $expense['name'] = 'Expense';
        $expense['amount'] = $expenseAbAccount->getLedgerBalance();

        $this->expenseTotal = $expense['amount'];

        $this->expenseItems[] = $expense;
    }

    public function calculateGrossProfit(): void
    {
        $this->grossProfit = $this->revenueTotal - $this->cogsTotal;
    }

    public function calculateNetProfit(): void
    {
        $this->netProfit = $this->grossProfit - $this->expenseTotal;
    }
    /* This taken from income statement to calculate retained earnings. */
}
