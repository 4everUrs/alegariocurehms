<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Chart of Accounts') }}
        </h2>
    </x-slot>
    @isAdmin
    <button class="btn btn-sm btn-primary mb-3" data-bs-target="#newAccount" data-bs-toggle="modal">+ Add new
        account
    </button>
    @endisAdmin
   <div class="card" wire:ignore>
    <div class="card-body">
        <h5 class="card-title">Accounts</h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="Assets-tab" data-bs-toggle="tab" data-bs-target="#Assets" type="button"
                        role="tab" aria-controls="Assets" aria-selected="true">Assets</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Liabilities-tab" data-bs-toggle="tab" data-bs-target="#Liabilities" type="button"
                        role="tab" aria-controls="Liabilities" aria-selected="false">Liabilities</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Expenses-tab" data-bs-toggle="tab" data-bs-target="#Expenses" type="button"
                        role="tab" aria-controls="Expenses" aria-selected="false">Expenses</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Revenue-tab" data-bs-toggle="tab" data-bs-target="#Revenue" type="button" role="tab"
                        aria-controls="Revenue" aria-selected="false">Revenue</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="Equity-tab" data-bs-toggle="tab" data-bs-target="#Equity" type="button" role="tab"
                        aria-controls="Equity" aria-selected="false">Equity</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Assets" role="tabpanel" aria-labelledby="Assets-tab">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable table-sm">
                                <thead>
                                    <th>Account No</th>
                                    <th>Account Name</th>
                                    <th>Account Type</th>
                                    <th>Balance</th>
                                    @isAdmin
                                    <th class="text-center align-middle">Action</th>
                                    @endisAdmin
                                </thead>
                                <tbody>
                                    @foreach ($assets as $asset)
                                    <tr>
                                        <td>{{$asset->id}}</td>
                                        <td>{{$asset->name}}</td>
                                        <td>{{$asset->type}}</td>
                                        <td>@money($asset->balance)</td>
                                        @isAdmin
                                        <td class="text-center align-middle">
                                            <button class="btn btn-success btn-sm" wire:click="edit({{$asset->id}})">EDIT</button>
                                        </td>
                                        @endisAdmin
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="Liabilities" role="tabpanel" aria-labelledby="Liabilities-tab">
                    <table class="table datatable table-sm">
                        <thead>
                            <th>Account No</th>
                            <th>Account Name</th>
                            <th>Account Type</th>
                            <th>Balance</th>
                            @isAdmin
                            <th class="text-center align-middle">Action</th>
                            @endisAdmin
                        </thead>
                        <tbody>
                            @foreach ($liabilities as $asset)
                            <tr>
                                <td>{{$asset->id}}</td>
                                <td>{{$asset->name}}</td>
                                <td>{{$asset->type}}</td>
                                <td>@money($asset->balance)</td>
                                @isAdmin
                                <td class="text-center align-middle">
                                    <button class="btn btn-success btn-sm" wire:click="edit({{$asset->id}})">EDIT</button>
                                </td>
                                @endisAdmin
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="Expenses" role="tabpanel" aria-labelledby="Expenses-tab">
                    <table class="table datatable table-sm">
                        <thead>
                            <th>Account No</th>
                            <th>Account Name</th>
                            <th>Account Type</th>
                            <th>Balance</th>
                            @isAdmin
                            <th class="text-center align-middle">Action</th>
                            @endisAdmin
                        </thead>
                        <tbody>
                            @foreach ($expenses as $asset)
                            <tr>
                                <td>{{$asset->id}}</td>
                                <td>{{$asset->name}}</td>
                                <td>{{$asset->type}}</td>
                                <td>@money($asset->balance)</td>
                                @isAdmin
                                <td class="text-center align-middle">
                                    <button class="btn btn-success btn-sm" wire:click="edit({{$asset->id}})">EDIT</button>
                                </td>
                                @endisAdmin
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="Revenue" role="tabpanel" aria-labelledby="Revenue-tab">
                    <table class="table datatable table-sm">
                        <thead>
                            <th>Account No</th>
                            <th>Account Name</th>
                            <th>Account Type</th>
                            <th>Balance</th>
                            @isAdmin
                            <th class="text-center align-middle">Action</th>
                            @endisAdmin
                        </thead>
                        <tbody>
                            @foreach ($revenue as $asset)
                            <tr>
                                <td>{{$asset->id}}</td>
                                <td>{{$asset->name}}</td>
                                <td>{{$asset->type}}</td>
                                <td>@money($asset->balance)</td>
                                @isAdmin
                                <td class="text-center align-middle">
                                    <button class="btn btn-success btn-sm" wire:click="edit({{$asset->id}})">EDIT</button>
                                </td>
                                @endisAdmin
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="Equity" role="tabpanel" aria-labelledby="Equity-tab">
                    <table class="table datatable table-sm">
                        <thead>
                            <th>Account No</th>
                            <th>Account Name</th>
                            <th>Account Type</th>
                            <th>Balance</th>
                            @isAdmin
                            <th class="text-center align-middle">Action</th>
                            @endisAdmin
                        </thead>
                        <tbody>
                            @foreach ($equity as $asset)
                            <tr>
                                <td>{{$asset->id}}</td>
                                <td>{{$asset->name}}</td>
                                <td>{{$asset->type}}</td>
                                <td>@money($asset->balance)</td>
                                @isAdmin
                                <td class="text-center align-middle">
                                    <button class="btn btn-success btn-sm" wire:click="edit({{$asset->id}})">EDIT</button>
                                </td>
                                @endisAdmin
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
    </div>
</div>
<x-breeze-modal id="newAccount" model="newAccount" wire:ignore>
    <x-slot name="title">
        add new account
    </x-slot>

    <x-slot name="body">
        <div class="form-group">
            <label>Account Type</label>
            <select class="form-select" wire:model="type">
                <option value="">Choose..</option>
                <option value="Asset">Assets</option>
                <option value="Liabilities">Liabilities</option>
                <option value="Revenue">Revenue</option>
                <option value="Equity">Equity</option>
                <option value="Expenses">Expenses</option>
            </select>
            @error('type') <span class="text-danger">{{ $message }}</span><br> @enderror
            <label>Account Name</label>
            <input type="text" class="form-control" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            <div class="d-none" id="balance">
                <label>Balance</label>
                <input type="text" class="form-control" wire:model="balance">
                @error('balance') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </x-slot>
</x-breeze-modal>

<x-breeze-modal id="editModal" model="saveEdit" wire:ignore.self>
    <x-slot name="title">Edit</x-slot>
    <x-slot name="body">    
        @if ($chart)
            <label>Account Name</label>
            <input type="text" class="form-control" wire:model="name" disabled>
            <label>Balance</label>
            <input type="text" class="form-control" wire:model="balance">
            @error('balance') <span class="text-danger">{{ $message }}</span> @enderror
        @endif
    </x-slot>
</x-breeze-modal>
<script>
    window.addEventListener('close-modal-account', event => {
    $('#newAccount').modal('hide')
    })
    window.addEventListener('open-modal', event => {
    $('#editModal').modal('show')
    })
    window.addEventListener('close-modal', event => {
    $('#editModal').modal('hide')
    })
    window.addEventListener('show-balance', event => {
        var x = document.getElementById('balance');
        x.classList.remove('d-none');
    })
</script>
</div>
