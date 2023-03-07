<?php

namespace App\Http\Livewire\Bm;

use App\Models\Budget;
use App\Models\BudgetRequest;
use App\Models\disbursement\DisburseRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RequestList extends Component
{
    public $request_id, $remarks;
    public function render()
    {
        return view('livewire.bm.request-list', [
            'requests' => BudgetRequest::all(),
            'approved' => BudgetRequest::where('status', 'Approved')->get(),
            'pending' => BudgetRequest::where('status', 'Pending')->get(),
            'denied' => BudgetRequest::where('status', 'Denied')->get(),
        ]);
    }
    public function approveRequest($id)
    {
        BudgetRequest::find($id)->update(
            [
                'status' => 'Approved',
                'date_approved' => Carbon::parse(now())->toFormattedDateString()
            ]
        );
        DisburseRequest::create(
            [
                'budget_requests_id' => $id,
                'status' => 'Pending'
            ]
        );
        toastr()->addSuccess('Approve Successfully');
    }
    public function denyRequestId($id)
    {
        $this->request_id = $id;
    }
    public function denyRequest()
    {
        BudgetRequest::find($this->request_id)->update(
            [
                'status' => 'Denied',
                'remarks' => $this->remarks,
            ]
        );
        toastr()->addSuccess('Denied Successfully');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function download($id)
    {
        $requestBudget = BudgetRequest::find($id);
        // return Storage::disk('public')->streamDownload($requestBudget->file_name);
        return response()->streamDownload(storage_path($requestBudget->file_name));
    }
}
