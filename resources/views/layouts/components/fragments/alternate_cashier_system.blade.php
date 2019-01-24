@foreach($getProduct as $product)
<div class="col-3 mb-3" id="{{$ascid += 1}}">
    <div class="card">
        <div class="card-header bg-primary text-white">
                ({{$count += 1}}) {{$product->product_name}}
        </div>
        <div class="card-body">
            @php
                echo $getCategoryName->find($product->category_id)->category_name;
            @endphp
        </div>
        <div class="card-footer">
            ₱{{$product->price}}
        </div>
    </div>      
</div>  
<script>
$(document).ready(function(event) {
    if(event.keyCode === {{$ck += 1}}) {
        var tid = $('#transaction_id').text();
        var product_name = '{{$product->product_name}}';
        var price = {{$product->price}};
        var multiplier = 1;
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
    }
});
</script>
@endforeach