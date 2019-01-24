<!-- Modal -->
<div class="modal fade" id="checkout-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Checkout Order?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <span class="lead mb-2">
                Are you sure you want to make this order?
            </span>
            <div id="orders_confirm">
                <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Qty</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                          </tr>
                        </thead>
                        <tbody id="confirm_output">
                        </tbody>
                    </table>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#orderBy">Yes</button>
        </div>
        </div>
    </div>
</div>