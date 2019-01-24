<div class="modal fade quantity-modal" id="exampleModalLong_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title h5" id="exampleModalLongTitle">How Many?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12 text-center h5 mb-4">
                {{$product->product_name}}
                </div>
            </div>
            <div class="row text-center">
                <div class="col-2 offset-3">
                    <button type="button" id="decrement_{{$product->id}}" class="btn btn-primary h5">-</button>
                </div>
                <div class="col-2">
                    <input type="text" name="product_quantity" class="form-control d-block" id="quantity_{{$product->id}}">
                </div>
                <div class="col-2">
                    <button type="button" id="increment_{{$product->id}}" class="btn btn-primary h5">+</button>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add_to_cart_{{$product->id}}">Save changes</button>
        </div>
        </div>
    </div>
    <!--Hidden Fields-->
    <!--Hidden Fields-->
</div>
<script>


$('#increment_{{$product->id}}').click(function () {
    var qty = Number($('#quantity_{{$product->id}}').val());
    var count = qty+=1;
    $('#quantity_{{$product->id}}').val(count);
    if($('#quantity_{{$product->id}}').val() >= 200) {
        $('#quantity_{{$product->id}}').val(200);
    }
});

$('#decrement_{{$product->id}}').click(function () {
    var qty = Number($('#quantity_{{$product->id}}').val());
    var count = qty-=1;
    $('#quantity_{{$product->id}}').val(count);
    if($('#quantity_{{$product->id}}').val() <= 0) {
        $('#quantity_{{$product->id}}').val(1);
    }
});

$('#quantity_{{$product->id}}').change(function() {
    if($('#quantity_{{$product->id}}').val() <= 0) {
        $('#quantity_{{$product->id}}').val(1);
    }
    if($('#quantity_{{$product->id}}').val() >= 200) {
        $('#quantity_{{$product->id}}').val(200);
        alert('The maximum order count is 200. Max orders will be processed.');
    }
});

$('#exampleModalLong_{{$product->id}}').on('shown.bs.modal', function () {
    $('#quantity_{{$product->id}}').val(1);
})

$('#add_to_cart_{{$product->id}}').click(function() {
    var tid = $('#transaction_id').text();
    var product_name = '{{$product->product_name}}';
    var price = {{$product->price}};
    var multiplier = $('#quantity_{{$product->id}}').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax( {
        dataType : 'html',
        url : './add_order',
        type : 'post',
        data : {
            'trans_id' : tid,
            'order_name' : product_name,
            'price' : Number(price)*Number(multiplier),
            'quantity' : multiplier,
        },
        success : function (data) {
            $('#counter').val('');
            $('#counter').focus();
            $.ajax( {
                dataType : 'html',
                url : './get_orders',
                type : 'get',
                data : {
                    'tid' : tid,
                },
                success : function (result) {
                
                $('#exampleModalLong_{{$product->id}}').modal('toggle');
                $('.modal-backdrop').addClass('hidden');
                $('#order_qty').html(multiplier);
                $('#order_name_display').html(product_name);
                $('#output').html(Number(price)*Number(multiplier));
                $('#orders_window').html(result);    
                $('#sidebar').animate({
                    scrollTop: $('#sidebar').offset().top + $('#sidebar')[0].scrollHeight
                });
                },
                complete : function () {
                    var count = $('#total_price').val();
                    var total = parseFloat(count).toFixed(2);
                    $('#price_to_pay').html(total); 
                },
                error : function(xhr, status,error) {
                    console.log(xhr.responseText);
                }
            });  
        },
        error : function(xhr, status,error) {
            console.log(xhr.responseText);
        }
    });
});
</script>