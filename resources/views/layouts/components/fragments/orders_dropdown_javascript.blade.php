<script>
$('#order_{{$orders->transaction_id}}').click(function() {
    var tid = {{$orders->transaction_id}};
    $('#transaction_id').text(tid)
    $('#cashier').show();
    $('#cover').hide();

    $.ajax( {
        dataType : 'html',
        url : './get_orders',
        type : 'get',
        data : {
            'tid' : tid,
        },
        success : function (result) {
            $('#orders_window').html(result);
            
        },
        error : function(xhr, status,error) {
            console.log(xhr.responseText);
        }
    }); 
});
</script>