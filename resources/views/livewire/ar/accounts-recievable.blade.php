<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Accounts Recievable') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Recievables</h5>
            <table class="table datatable">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Collection ID</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Accounts</th>
                    <th class="text-center">Encoder</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($recievables as $index => $recievable)
                        <tr>
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">@date($recievable->created_at)</td>
                            <td class="text-center">{{$recievable->NewestCollection->id}}</td>
                            <td class="text-center">{{$recievable->NewestCollection->category}}</td>
                            <td class="text-center">{{$recievable->NewestCollection->account}}</td>
                            <td class="text-center">{{$recievable->NewestCollection->encoder}}</td>
                            <td class="text-center">@money($recievable->NewestCollection->total_amount)</td>
                            <td class="text-center">{{$recievable->NewestCollection->description}}</td>
                            <td class="text-center">{{$recievable->NewestCollection->status}}</td>
                            <td class="text-center">
                                @if ($recievable->NewestCollection->status != 'Claimed')
                                    <button class="btn btn-primary btn-sm" wire:click='pay_now({{$recievable->id}})'>Pay Now</button>
                                @else
                                    <button class="btn btn-secondary btn-sm" wire:click='pay_now({{$recievable->id}})' disabled>Claimed</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-breeze-modal id="payNowModal" model="payNow" wire:ignore.self>
        <x-slot name="title">Pay now</x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Amount</label>
                <select wire:model="payment" class="form-select">
                    <option value="">Choose...</option>
                    @if ($installments)
                       <option value="{{$installments->NewestCollection->balance}}">
                            <table class="table table-sm">
                                <tr>
                                    <td style="width: 50%">Full Payment</td>
                                    <td>@money($installments->NewestCollection->balance)</td>
                                </tr>
                            </table>
                       </option>
                       <option value="{{$installments->NewestCollection->monthly_payment}}">
                            <table class="table">
                                <tr>
                                    <td style="width: 50%">Monthly Payment</td>
                                    <td>@money($installments->NewestCollection->monthly_payment)</td>
                                </tr>
                            </table>
                       </option>
                       
                    @endif
                </select>
            </div>
        </x-slot>
    </x-breeze-modal>

    <x-breeze-modal id="createRecievable" model="createRecievable" wire:ignore.self>
        <x-slot name="title">Create Recievables</x-slot>
        <x-slot name="body">
            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" wire:model='type'>
                <label>Amount</label>
                <input type="text" class="form-control" wire:model='amount'>
            </div>
        </x-slot>
    </x-breeze-modal>


    <script>
        window.addEventListener('show-modal', event=>{
            $('#payNowModal').modal('show');
        })
        window.addEventListener('close-modal', event=>{
            $('#payNowModal').modal('hide');
        })
        window.addEventListener('close-modal-recievable', event=>{
            $('#createRecievable').modal('hide');
        })
    </script>
</div>
