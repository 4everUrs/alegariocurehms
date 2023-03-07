<?php

namespace App\Http\Livewire\General;

use App\Models\Entry;
use App\Models\JournalEntry;
use Livewire\Component;

class TrialBalance extends Component
{
    public $totalCredit = 0, $totalDebit = 0;
    public function render()
    {
        return view('livewire.general.trial-balance', [
            'balances' => Entry::all(),
            'credits' => Entry::where('debit', '!=', null)->get(),
            'debits' => Entry::where('credit', '!=', null)->get(),
        ]);
    }
    public function mount()
    {
        $credits = Entry::where('credit', '!=', null)->get();
        foreach ($credits as $credit) {
            $this->totalCredit += $credit->credit;
        }
        $debits = Entry::where('debit', '!=', null)->get();
        foreach ($debits as $debit) {
            $this->totalDebit += $debit->debit;
        }
    }
}
