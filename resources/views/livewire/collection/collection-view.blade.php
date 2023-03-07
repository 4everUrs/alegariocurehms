<div>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Collection') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Collections</h5>
            <table class="table datatable">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Invoice ID</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Accounts</th>
                    <th class="text-center">Encoder</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>

                </thead>
                <tbody>
                    @foreach ($collections as $index => $collection)
                        <tr>
                            <td class="text-center">{{$index+1}}</td>
                            <td class="text-center">@date($collection->created_at)</td>
                            <td class="text-center">{{$collection->invoice_id}}</td>
                            <td class="text-center">{{$collection->category}}</td>
                            <td class="text-center">{{$collection->account}}</td>
                            <td class="text-center">{{$collection->encoder}}</td>
                            <td class="text-center">@money($collection->amount)</td>
                            <td class="text-center">{{$collection->description}}</td>
                            <td class="text-center">{{$collection->status}}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
