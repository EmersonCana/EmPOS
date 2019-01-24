<div class="col-3 bg-light fluid">
    <div class="p-4">
        <div class="mr-3">
            <table class="table table-hover small">
                <thead>
                    <tr>
                    <th scope="col">Qty</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="sidebar-scroll" id="sidebar">
            <table class="table table-hover small">
                <tbody id="orders_window">
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <span class="h4" id="price_label">Price: </span>
            <span class="h4">₱</span><span id="price_to_pay" class="h4"></span><br><hr>
            <a id="checkout" class="btn btn-success btn-block text-light" data-toggle="modal" data-target="#checkout-modal">Checkout</a>
            <a id="checkout" class="btn btn-warning btn-block text-light" data-toggle="modal" data-target="#save_transaction">Save Transaction</a>
            @include('layouts.components.modals.checkout-modal')
            @include('layouts.components.modals.order_by_modal')
            @include('layouts.components.modals.order_success_modal')
            @include('layouts.components.modals.save_transaction_modal')
            @include('layouts.components.modals.save_transaction_success_modal')
        </div>

    </div>

    
</div>