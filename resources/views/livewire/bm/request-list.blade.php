<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Request List') }}
        </h2>
    </x-slot>
    <div class="card">
        <div class="card-body p-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist" wire:ignore>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="Pending-tab" data-bs-toggle="tab" data-bs-target="#Pending" type="button"
                        role="tab" aria-controls="Pending" aria-selected="true">Pending</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Approved-tab" data-bs-toggle="tab" data-bs-target="#Approved" type="button"
                        role="tab" aria-controls="Approved" aria-selected="false">Approved</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Denied-tab" data-bs-toggle="tab" data-bs-target="#Denied" type="button"
                        role="tab" aria-controls="Denied" aria-selected="false">Denied</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Pending" role="tabpanel" aria-labelledby="Pending-tab" wire:ignore.self>
                    <div class="card">
                        <div class="card-body p-3">
                            <table class="table-sm datatable">
                                <thead>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Department</th>
                                    <th class="text-center align-middle">Requestor</th>
                                    <th class="text-center align-middle">Description</th>
                                    <th class="text-center align-middle">Proposed Amount</th>
                                    <th class="text-center align-middle">Approved Amount</th>
                                    <th class="text-center align-middle">Date Request</th>
                                    <th class="text-center align-middle">Date Approved</th>
                                    <th class="text-center align-middle">Attachment</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Remarks</th>
                                    <th class="text-center align-middle">Action</th>
                                </thead>
                                @if ($pending)
                                    @foreach ($pending as $request)
                                    <tr>
                                        <td class="text-center align-middle">{{$request->id}}</td>
                                        <td class="text-center align-middle">{{$request->department}}</td>
                                        <td class="text-center align-middle">{{$request->requestor}}</td>
                                        <td class="text-center align-middle">{{$request->description}}</td>
                                        <td class="text-center align-middle">@money($request->amount)</td>
                                        @if (!empty($request->approved_amount))
                                        <td class="text-center align-middle">@money($request->approved_amount)</td>
                                        @else
                                        <td class="text-center align-middle">N/A</td>
                                        @endif
                                        <td class="text-center align-middle">@date($request->created_at)</td>
                                        @if (!empty($request->date_approved))
                                        <td class="text-center align-middle">{{$request->date_approved}}</td>
                                        @else
                                        <td class="text-center align-middle">--/--/----</td>
                                        @endif
                                        @if (!empty($request->original_file_name))
                                        <td class="text-center align-middle"><a href="#"
                                                wire:click="download({{$request->id}})">{{$request->original_file_name}}</a></td>
                                        @else
                                        <td class="text-center align-middle">N/A</td>
                                        @endif
                                        <td class="text-center align-middle">{{$request->status}}</td>
                                        <td class="text-center align-middle">{{$request->remarks}}</td>
                                        <td class="text-center align-middle">
                                            @if ($request->status == 'Pending')
                                            <button wire:click="approveRequest({{$request->id}})" class="btn btn-sm btn-primary">Approve</button>
                                            <button wire:click="denyRequestId({{$request->id}})" data-bs-toggle="modal" data-bs-target="#remarkModal"
                                                class="btn btn-sm btn-danger">Deny</button>
                                            @else
                                            <button wire:click="approveRequest({{$request->id}})" class="btn btn-sm btn-secondary"
                                                disabled>Approved</button>
                                            <button disabled wire:click="denyRequestId({{$request->id}})" data-bs-toggle="modal"
                                                data-bs-target="#remarkModal" class="btn btn-sm btn-secondary">Denied</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Approved" role="tabpanel" aria-labelledby="Approved-tab" wire:ignore.self>
                    <div class="card">
                        <div class="card-body p-3">
                            <table class="table-sm datatable">
                                <thead>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Department</th>
                                    <th class="text-center align-middle">Requestor</th>
                                    <th class="text-center align-middle">Description</th>
                                    <th class="text-center align-middle">Proposed Amount</th>
                                    <th class="text-center align-middle">Approved Amount</th>
                                    <th class="text-center align-middle">Date Request</th>
                                    <th class="text-center align-middle">Date Approved</th>
                                    <th class="text-center align-middle">Attachment</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Remarks</th>
                                    <th class="text-center align-middle">Action</th>
                                </thead>
                                @if ($approved)
                                    @foreach ($approved as $request)
                                    <tr>
                                        <td class="text-center align-middle">{{$request->id}}</td>
                                        <td class="text-center align-middle">{{$request->department}}</td>
                                        <td class="text-center align-middle">{{$request->requestor}}</td>
                                        <td class="text-center align-middle">{{$request->description}}</td>
                                        <td class="text-center align-middle">@money($request->amount)</td>
                                        @if (!empty($request->approved_amount))
                                        <td class="text-center align-middle">@money($request->approved_amount)</td>
                                        @else
                                        <td class="text-center align-middle">N/A</td>
                                        @endif
                                        <td class="text-center align-middle">@date($request->created_at)</td>
                                        @if (!empty($request->date_approved))
                                        <td class="text-center align-middle">{{$request->date_approved}}</td>
                                        @else
                                        <td class="text-center align-middle">--/--/----</td>
                                        @endif
                                        @if (!empty($request->original_file_name))
                                        <td class="text-center align-middle"><a href="#"
                                                wire:click="download({{$request->id}})">{{$request->original_file_name}}</a></td>
                                        @else
                                        <td class="text-center align-middle">N/A</td>
                                        @endif
                                        <td class="text-center align-middle">{{$request->status}}</td>
                                        <td class="text-center align-middle">{{$request->remarks}}</td>
                                        <td class="text-center align-middle">
                                            @if ($request->status == 'Pending')
                                            <button wire:click="approveRequest({{$request->id}})" class="btn btn-sm btn-primary">Approve</button>
                                            <button wire:click="denyRequestId({{$request->id}})" data-bs-toggle="modal" data-bs-target="#remarkModal"
                                                class="btn btn-sm btn-danger">Deny</button>
                                            @else
                                            <button wire:click="approveRequest({{$request->id}})" class="btn btn-sm btn-secondary"
                                                disabled>Approved</button>
                                            <button disabled wire:click="denyRequestId({{$request->id}})" data-bs-toggle="modal"
                                                data-bs-target="#remarkModal" class="btn btn-sm btn-secondary">Denied</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Denied" role="tabpanel" aria-labelledby="Denied-tab" wire:ignore.self>
                    <div class="card">
                        <div class="card-body p-3">
                            <table class="table-sm datatable">
                                <thead>
                                    <th class="text-center align-middle">No.</th>
                                    <th class="text-center align-middle">Department</th>
                                    <th class="text-center align-middle">Requestor</th>
                                    <th class="text-center align-middle">Description</th>
                                    <th class="text-center align-middle">Proposed Amount</th>
                                    <th class="text-center align-middle">Approved Amount</th>
                                    <th class="text-center align-middle">Date Request</th>
                                    <th class="text-center align-middle">Date Approved</th>
                                    <th class="text-center align-middle">Attachment</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Remarks</th>
                                    <th class="text-center align-middle">Action</th>
                                </thead>
                                @if ($denied)
                                @foreach ($denied as $request)
                                <tr>
                                    <td class="text-center align-middle">{{$request->id}}</td>
                                    <td class="text-center align-middle">{{$request->department}}</td>
                                    <td class="text-center align-middle">{{$request->requestor}}</td>
                                    <td class="text-center align-middle">{{$request->description}}</td>
                                    <td class="text-center align-middle">@money($request->amount)</td>
                                    @if (!empty($request->approved_amount))
                                    <td class="text-center align-middle">@money($request->approved_amount)</td>
                                    @else
                                    <td class="text-center align-middle">N/A</td>
                                    @endif
                                    <td class="text-center align-middle">@date($request->created_at)</td>
                                    @if (!empty($request->date_approved))
                                    <td class="text-center align-middle">{{$request->date_approved}}</td>
                                    @else
                                    <td class="text-center align-middle">--/--/----</td>
                                    @endif
                                    @if (!empty($request->original_file_name))
                                    <td class="text-center align-middle"><a href="#"
                                            wire:click="download({{$request->id}})">{{$request->original_file_name}}</a></td>
                                    @else
                                    <td class="text-center align-middle">N/A</td>
                                    @endif
                                    <td class="text-center align-middle">{{$request->status}}</td>
                                    <td class="text-center align-middle">{{$request->remarks}}</td>
                                    <td class="text-center align-middle">
                                        @if ($request->status == 'Pending')
                                        <button wire:click="approveRequest({{$request->id}})" class="btn btn-sm btn-primary">Approve</button>
                                        <button wire:click="denyRequestId({{$request->id}})" data-bs-toggle="modal" data-bs-target="#remarkModal"
                                            class="btn btn-sm btn-danger">Deny</button>
                                        @else
                                        <button wire:click="approveRequest({{$request->id}})" class="btn btn-sm btn-secondary"
                                            disabled>Approved</button>
                                        <button disabled wire:click="denyRequestId({{$request->id}})" data-bs-toggle="modal"
                                            data-bs-target="#remarkModal" class="btn btn-sm btn-secondary">Denied</button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <x-breeze-modal id="remarkModal" model="denyRequest" wire:ignore.self>
        <x-slot name="title">
            Remarks
        </x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Remarks</label>
                <textarea rows="5" class="form-control" wire:model="remarks"></textarea>
            </div>
        </x-slot>
    </x-breeze-modal>
    <script>
        window.addEventListener('close-modal', event => {
        $('#remarkModal').modal('hide')
        })
    </script>
</div>
