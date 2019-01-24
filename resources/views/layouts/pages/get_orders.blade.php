
@foreach($getOrders as $get)
<tr class="text-center" id="order_{{$get->id}}">
<th scope="row">{{$get->quantity}}</th>
    <td>{{$get->order_name}}</td>
    <td>₱{{$get->price}}</td>
    <td><a id="delete_{{$get->id}}" style="cursor:pointer;" data-toggle="modal" data-target="#delete_item_modal_{{$get->id}}">&times;</a></td>
    <td class="hidden"><input type="hidden" id="total_price" value="{{$sumOrders}}">
    
        <div class="modal fade quantity-modal" id="delete_item_modal_{{$get->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title h5" id="exampleModalLongTitle">Delete From List?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center h5 mb-4">
                            Are you sure you want to delete {{$get->order_name}}?
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="delete_to_cart_{{$get->id}}">Delete</button>
                    </div>
                    </div>
                </div>
            </div>
    </td>
</tr>
<script>
        $('#delete_to_cart_{{$get->id}}').click(function() {
            var tid = $('#transaction_id').text();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        
            $.ajax( {
                dataType : 'html',
                url : './delete_order',
                type : 'POST',
                data : {
                    'pid' : '{{$get->id}}',
                    'tid' : tid,
                },
                success : function (result) {
                $('#delete_item_modal_{{$get->id}}').modal('hide');
                $('.modal-backdrop').removeClass('modal-backdrop');
                $('.modal-backdrop').addClass('hidden');
                $('#orders_window').html(result);   
                
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
        });
    </script>
@endforeach
<script>
$('#checkout').removeClass('disabled');
$('#checkout').addClass('enabled');
</script>


