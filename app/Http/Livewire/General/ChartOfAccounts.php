<?php

namespace App\Http\Livewire\General;

use App\Models\Chart;
use Livewire\Component;

class ChartOfAccounts extends Component
{
    public $type, $name, $balance, $selected_id, $chart;
    protected $rules = [
        'type' => 'required',
        'name' => 'required|string',
        'balance' => 'required|int|min:1'
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function render()
    {
        if ($this->type == 'Equity') {
            $this->dispatchBrowserEvent('show-balance');
        }
        return view('livewire.general.chart-of-accounts', [
            'assets' => Chart::where('type', 'Asset')->get(),
            'liabilities' => Chart::where('type', 'liabilities')->get(),
            'expenses' => Chart::where('type', 'expenses')->get(),
            'revenue' => Chart::where('type', 'revenue')->get(),
            'equity' => Chart::where('type', 'equity')->get(),
        ]);
    }

    public function newAccount()
    {
        $validatedData = $this->validate();

        if ($this->type != 'Equity') {
            Chart::create($validatedData);
        } else {
            Chart::create([
                'type' => $this->type,
                'name' => $this->name,
                'balance' => $this->balance
            ]);
        }
        toastr()->addSuccess('Create account succesfully');

        $this->dispatchBrowserEvent('close-modal-account');
        $this->reset();
    }
    public function edit($id)
    {
        $this->selected_id = $id;
        $this->chart = Chart::find($id);
        $this->name = $this->chart->name;
        $this->balance = $this->chart->balance;
        $this->dispatchBrowserEvent('open-modal');
    }
    public function saveEdit()
    {

        $this->validate();
        Chart::find($this->selected_id)->update([
            'name' => $this->name,
            'balance' => $this->balance
        ]);
        toastr()->addSuccess('Edit Success');
        $this->dispatchBrowserEvent('close-modal');
    }
}
