<?php

namespace App\Http\Livewire\Ar;

use App\Models\Chart;
use App\Models\Entry;
use App\Models\JournalEntry;
use App\Models\NewestCollection;
use App\Models\Recievable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AccountsRecievable extends Component
{
    public $amount, $selected_id;
    public $installments, $type, $payment;
    public function render()
    {
        return view('livewire.ar.accounts-recievable', [
            'recievables' => Recievable::all()
        ]);
    }
    // public function mount()
    // {
    //     $temp = Recievable::with('NewestCollection')->get();
    //     dd($temp);
    // }
    public function pay_now($id)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->selected_id = $id;
        $this->installments = Recievable::find($id);
    }
    public function payNow()
    {
        $recievable = Recievable::find($this->selected_id);

        $collection = NewestCollection::find($recievable->newest_collection_id);
        $collection->balance = $collection->balance - $this->payment;
        $collection->save();

        if ($collection->balace == 0) {
            $collection->status = 'Claimed';
            $collection->save();
        };


        $this->updateAccount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function createRecievable()
    {
        Recievable::create([
            'type' => $this->type,
            'amount' => $this->amount,
            'status' => 'Unpaid'
        ]);
        toastr()->addSuccess('Create Successfully');
        $this->dispatchBrowserEvent('close-modal-recievable');
    }
    public function updateAccount()
    {
        $cash = Chart::find('10003');
        $cash->balance = $cash->balance + $this->payment;
        $cash->save();

        $recievable = Chart::find('10001');
        $recievable->balance = $recievable->balance - $this->payment;
        $recievable->save();

        JournalEntry::create([
            'encoder' => Auth::user()->name,
            'description' => 'Recievable payment'
        ]);
        $journal = JournalEntry::latest()->first();
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Cash',
            'debit' => $this->payment,
        ]);
        Entry::create([
            'journal_entry_id' => $journal->id,
            'account' => 'Accounts Recievable',
            'credit' => $this->payment,
        ]);
    }
}
