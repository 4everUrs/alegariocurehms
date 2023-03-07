<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Trial Balance') }}
        </h2>
    </x-slot>
    <div class="card bg-info">
        <div class="card-body">
            <div class="row">
                <div class="col p-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Credit</h5>
                            <table class="table table-striped table-sm">
                                <thead class="bg-secondary">
                                    <th class="text-center">Account</th>
                                    <th class="text-center">Credit</th>
                                </thead>
                                <tbody>
                                   @if ($debits)
                                       @forelse ($debits as $debit)
                                           <tr>
                                            <td>{{$debit->account}}</td>
                                            <td>@money($debit->debit)</td>
                                           </tr>
                                       @empty
                                           <tr class="text-center">
                                            <td colspan="2">No Record Found</td>
                                           </tr>
                                       @endforelse
                                   @endif
                                </tbody>
                                <tfoot>
                                    <td>Total:</td>
                                    <td>@money($totalCredit)</td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col p-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Debit</h5>
                            <table class="table table-striped table-sm">
                                <thead class="bg-secondary">
                                    <th class="text-center">Account</th>
                                    <th class="text-center">Debit</th>
                                </thead>
                                <tbody>
                                    @if ($credits)
                                    @forelse ($credits as $credit)
                                    <tr>
                                        <td>{{$credit->account}}</td>
                                        <td>@money($credit->debit)</td>
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="2">No Record Found</td>
                                    </tr>
                                    @endforelse
                                    @endif
                                </tbody>
                                <tfoot>
                                    <td>Total:</td>
                                    <td>@money($totalDebit)</td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col p-3">
                   <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Balance</h5>
                        <table class="table table-striped table-sm">
                            <thead class="bg-secondary">
                                <th class="text-center">Account</th>
                                <th class="text-center">Credit</th>
                                <th class="text-center">Debit</th>
                            </thead>
                            <tbody>
                                @if ($balances)
                                    @forelse ($balances as $balance)
                                        <tr>
                                            <td>{{$balance->account}}</td>
                                            <td>@money($balance->credit)</td>
                                            <td>@money($balance->debit)</td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                @endif
                            </tbody>
                            <tfoot>
                                <tr class="bg-info">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Total:</td>
                                    
                                    <td>@money($totalCredit)</td>
                                    <td>@money($totalDebit)</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
