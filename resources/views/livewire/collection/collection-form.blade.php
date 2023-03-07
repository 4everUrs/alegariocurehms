<div>
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
    
                    <div class="d-flex justify-content-center py-4">
                        <a href="index.html" class="logo d-flex align-items-center w-auto">
                            <img src="assets/img/logo.png" alt="">
                            <span class="d-none d-lg-block">AlergioCureHMS</span>
                        </a>
                    </div><!-- End Logo -->
    
                    <div class="card mb-3" style="width: 150%">
    
                        <div class="card-body p-4">
                            <div class="form-group">
                                <h1 class="text-center">Collection Form</h1>
                                <label>Encoder</label>
                                <input wire:model='encoder' type="text" class="form-control">
                                @error('encoder') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Category</label>
                                <select wire:model="category" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="Accounts Recievables">Accounts Recievables</option>
                                    <option value="Notes Recievables">Notes Recievables</option>
                                    <option value="Others Recievables">Others Recievables</option>
                                </select>
                                @error('category') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <div class="d-none" id="accounts">
                                    <label>Accounts</label>
                                    <select wire:model="account" class="form-select">
                                        <option value="">Choose...</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Sales">Sales</option>
                                        <option value="Revenue">Revenue</option>
                                    </select>
                                    @error('account') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                </div>
                                <div class="d-none" id="notes">
                                    <label>Accounts</label>
                                    <select wire:model="account" class="form-select">
                                        <option value="">Choose...</option>
                                        <option value="Installment">Installment</option>
                                        <option value="Loan">Loan</option>
                                    </select>
                                    @error('account') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                </div>
                                <div class="d-none" id="installment">
                                    <label>Terms</label>
                                    <input wire:model='terms' type="number" class="form-control">
                                    @error('terms') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                    <label>Downpayment</label>
                                    <input wire:model='downpayment' type="number" class="form-control">
                                    @error('downpayment') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                    <label>Interest</label>
                                    <input wire:model='interest' type="number" class="form-control">
                                    @error('interest') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                </div>
                                <label>Invoice No</label>
                                <input wire:model='invoice_id' type="text" class="form-control">
                                @error('invoice_id') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Amount</label>
                                <input wire:model='amount' type="number" class="form-control">
                                @error('amount') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Description</label>
                                <textarea wire:model='description' rows="5" class="form-control"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> <br> @enderror
                                <label>Attachment (Optional)</label>
                                <input wire:model='file_name' type="file" class="form-control">
                                <button wire:click="sendCollention" class="btn btn-primary form-control mt-3"
                                    wire:loading.class="bg-gray">Send
                                    <div wire:loading wire:target="sendCollention" class="spinner-border" role="status">
                                        <span class="sr-only">Uploading...</span>
                                    </div>
                                </button>
    
                                @error('file_name') <span class="text-danger">{{ $message }}</span> <br> @enderror
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    </section>

    <script>
        window.addEventListener('accounts',event=>{
            var accounts = document.getElementById('accounts');
            accounts.classList.remove('d-none');
        })
        window.addEventListener('notes',event=>{
            var notes = document.getElementById('notes');
            notes.classList.remove('d-none');
        })
        window.addEventListener('others',event=>{
            var others = document.getElementById('others');
            others.classList.remove('d-none');
        })
        window.addEventListener('installment',event=>{
            var installment = document.getElementById('installment');
            installment.classList.remove('d-none');
        })
    </script>
</div>
