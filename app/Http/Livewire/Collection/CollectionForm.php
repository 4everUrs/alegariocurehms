<?php

namespace App\Http\Livewire\Collection;

use App\Models\Chart;
use App\Models\Entry;
use App\Models\JournalEntry;
use App\Models\NewestCollection;
use App\Models\Recievable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CollectionForm extends Component
{
    public $encoder, $category, $account, $terms, $downpayment, $interest, $amount, $description, $attachment;
    public $invoice_id;
    public function render()
    {
        if ($this->category) {
            if ($this->category == 'Accounts Recievables') {
                $this->dispatchBrowserEvent('accounts');
            } elseif ($this->category == 'Notes Recievables') {
                $this->dispatchBrowserEvent('notes');
            } elseif ($this->category == 'Others Recievables') {
                $this->dispatchBrowserEvent('others');
            }
        }
        if ($this->account) {
            if ($this->account == 'Installment') {
                $this->dispatchBrowserEvent('installment');
            } else {
                $this->dispatchBrowserEvent('loan');
            }
        }
        return view('livewire.collection.collection-form')->layout('layouts.guest');;
    }

    public function sendCollention()
    {

        if ($this->account == 'Installment') {
            $this->installmentRule();
        } else {
            $this->addCash();
        }

        if ($this->category == 'Notes Recievables') {
            $this->insertInstallment();
        } else {
            $this->insertCollection();
        }
        $this->reset();
        toastr()->addSuccess('Collection Added Successfully');
    }
    public function insertInstallment()
    {
        $interestRate = $this->interest / 100;
        $interestAmount = $this->amount * $interestRate;
        $totalInterest = $interestAmount * $this->terms;
        $total = $this->amount + $totalInterest;
        $balance = $total - $this->downpayment;
        $monthly = $balance / $this->terms;
        NewestCollection::create([
            'encoder' => $this->encoder,
            'category' => $this->category,
            'account' => $this->account,
            'amount' => $this->amount,
            'total_amount' => $total,
            'description' => $this->description,
            'invoice_id' => $this->invoice_id,
            'account' => $this->account,
            'downpayment' => $this->downpayment,
            'terms' => $this->terms,
            'interest' => $this->interest,
            'monthly_payment' => $monthly,
            'balance' => $balance,
        ]);
        $temp = NewestCollection::latest()->first();
        Recievable::create([
            'newest_collection_id' => $temp->id
        ]);
        $this->createJournal();
        $this->reset();
    }
    public function createJournal()
    {
        $interestRate = $this->interest / 100;
        $interestAmount = $this->amount * $interestRate;
        $totalInterest = $interestAmount * $this->terms;
        $total = $this->amount + $totalInterest;
        $cash = Chart::find('10003');
        $cash->balance = $cash->balance + $this->downpayment;
        $cash->save();
        $recievables = Chart::find('10001');
        $recievables->balance = $recievables->balance + $total;
        $recievables->save();


        if ($this->account == 'Installment') {
            JournalEntry::create([
                'encoder' => Auth::user()->name,
                'description' => 'Installment downpayment'
            ]);
            $journal = JournalEntry::latest()->first();
            Entry::create([
                'journal_entry_id' => $journal->id,
                'account' => 'Cash',
                'debit' => $this->downpayment,
            ]);
            Entry::create([
                'journal_entry_id' => $journal->id,
                'account' => 'Accounts Recievable',
                'debit' => $total,
            ]);
        } elseif ($this->account == 'Loan') {
            JournalEntry::create([
                'encoder' => Auth::user()->name,
                'description' => 'Installment downpayment'
            ]);
            $journal = JournalEntry::latest()->first();
            Entry::create([
                'journal_entry_id' => $journal->id,
                'account' => 'Cash',
                'debit' => $this->amount,
            ]);
        }
    }
    public function insertCollection()
    {
        NewestCollection::create([
            'encoder' => $this->encoder,
            'category' => $this->category,
            'account' => $this->account,
            'amount' => $this->amount,
            'total_amount' => $this->amount,
            'description' => $this->description,
            'invoice_id' => $this->invoice_id,
            'account' => $this->account,
            'downpayment' => $this->downpayment,
            'terms' => $this->terms,
            'interest' => $this->interest,
            'status' => 'Claimed',
        ]);
        $cash = Chart::find('10003');
        $cash->balance = $cash->balance + $this->amount;
        $cash->save();
        JournalEntry::create([
            'encoder' => Auth::user()->name,
            'description' => 'Cash Collection'
        ]);
        $journal = JournalEntry::latest()->first();
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Cash',
            'debit' => $this->amount,
        ]);
    }
    public function installmentRule()
    {
        $this->validate([
            'encoder' => 'required|min:3',
            'category' => 'required',
            'invoice_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'terms' => 'required',
            'downpayment' => 'required|integer|min:0',
            'interest' => 'required|integer|min:0'
        ]);
    }
    public function addCash()
    {
        $this->validate([
            'encoder' => 'required|min:3',
            'category' => 'required',
            'invoice_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);
    }
}
