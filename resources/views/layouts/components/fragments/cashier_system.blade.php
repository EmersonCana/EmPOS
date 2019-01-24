<div class="col-9">
    <div id="cashier_alt">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="number" name="counter" id="counter" class="form-control" autofocus>
                    <input type="hidden" id="query_holder">
                </div>
                <div class="mt-2 input-group-addon">
                        <span id="order_qty"></span>&nbsp;<span id="order_name_display"></span> - ₱<span id="output"></span>
                </span>
                </div>
            </div>    
        </div>
        <div class="row">
                @include('layouts.components.fragments.alternate_cashier_system')
        </div>
        
    </div>
    <div id="hide-everything">
        <div id="cover">
            <div class="text-center p-4">
                <button class="btn btn-primary btn-lg btn-block" id="transaction_start">Start Transaction</button>
            </div>
        </div>

        <div id="cashier">
            <div class="p-4">
                <div class="input-group">
                    <span class="input-group-addon">₱</span>
                    <input type="number" name="counter" id="counter" class="form-control" autofocus>
                </div>
                <div class="mt-2 input-group-addon">
                        <span id="order_qty"></span>&nbsp;<span id="order_name_display"></span> - ₱<span id="output"></span>
                </span>
            </div>
            <div class="col-4 offset-8 mt-3 mb-3 text-right">
                <input type="text" name="search" id="search" placeholder="Search" class="form-control">
            </div>
            <div class="body-scroll">
            @include('layouts.components.fragments.main_product_list')
            </div>
            <div id="result_holder"></div>
        </div>
    </div>
</div>