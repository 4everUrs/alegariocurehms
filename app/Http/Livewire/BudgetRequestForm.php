<?php

namespace App\Http\Livewire;

use App\Models\BudgetRequest;
use Error;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class BudgetRequestForm extends Component
{
    public $requestor, $description, $amount, $file_name, $department;
    use WithFileUploads;
    protected $messages = [
        'requestor.required' => 'The Requestor cannot be empty.',
        'description.required' => 'The Description is required.',
        'department.required' => 'The Department is required.',
        'amount.required' => 'The Amount is required.',
        'amount.integer' => 'The amount is required and integer.',
    ];
    public function render()
    {
        return view('livewire.budget-request-form')->layout('layouts.guest');
    }
    public function sendRequest()
    {
        try {
            $originalFileName = $this->file_name->getClientOriginalName();
        } catch (Error $e) {
        }
        $this->validate([
            'requestor' => 'required|min:3',
            'description' => 'required',
            'amount' => 'required|integer',
            'department' => 'required',
        ]);
        if ($this->file_name) {
            try {
                BudgetRequest::create([
                    'requestor' => $this->requestor,
                    'description' => $this->description,
                    'amount' => $this->amount,
                    'department' => $this->department,
                    'file_name' =>  $this->file_name->store('budget_proposal', 'ftp'),
                    'original_file_name' => $originalFileName,
                ]);
                toastr()->addSuccess('Send Successfully');
                $this->reset();
            } catch (Error $e) {
                toastr()->addError('Operation Failed');
            }
        } else {
            try {
                BudgetRequest::create([
                    'requestor' => $this->requestor,
                    'description' => $this->description,
                    'amount' => $this->amount,
                    'department' => $this->department,
                ]);
                toastr()->addSuccess('Send Successfully');
                $this->reset();
            } catch (Error $e) {
                toastr()->addError('Operation Failed');
            }
        }
    }
}
