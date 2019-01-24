<script>

$(document).ready(function() {
    $('#counter').keyup(function(event) {
        if($('#counter').val() == 00) {
            if(event.keyCode === 32) {
                var tid = $('#transaction_id').text();
                $.ajax( {
                    dataType : 'html',
                    url : './make_order',
                    type : 'POST',
                    data : {
                        'tid' : tid,
                    },
                    success : function () {
                        
                        $.ajax( {
                            dataType : 'html',
                            url : './save_transaction',
                            type : 'POST',
                            data : {
                                'tid' : $('#transaction_id').text(),
                            },
                            success : function (response) {
                                $('#order_success').modal('show');
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
        }else{

        }
    });
    $('#cover').show();
    $('#cashier').hide();
    $('#counter').keyup(function(event) {
        var output = $('#counter').val();
        $('#query_holder').val(output);
        if(event.keyCode === 13) {
            
            $('#output').html(output);
            var tid = $('#transaction_id').text();
            var query = $('#counter').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax( {
                dataType : 'html',
                url : './add_order',
                type : 'POST',
                data : {
                    'key' : output,
                    'trans_id' : tid,
                },
                success : function (data) {
                    $('#counter').focus();
                    $.ajax( {
                        dataType : 'html',
                        url : './get_orders',
                        type : 'get',
                        data : {
                            'tid' : tid,
                        },
                        success : function (result) {
                        
                        $('#orders_window').html(result);
                        $('#sidebar').animate({
                            scrollTop: $('#sidebar').offset().top + $('#sidebar')[0].scrollHeight
                        });
                           
                        },
                        complete : function() {
                            $('#counter').val('');
                            var count = $('#total_price').val();
                            var total = parseFloat(count).toFixed(2);
                            $('#price_to_pay').html(total);
                        },
                        error : function(xhr, status,error) {
                            console.log(xhr.responseText);
                            $('#counter').val('');
                        }
                    });  
                },
                error : function(xhr, status,error) {
                    console.log(xhr.responseText);
                    $('#counter').val('');
                }
            });



        }
    });

    //Start Transaction Ajax
    $(document).ready(function() {
        $('#hide-everything').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax( {
            dataType : 'html',
            url : './transaction_start',
            type : 'post',
            success : function (data) {
                $('#cover').hide();
                $('#cashier').show();
                $('#counter').focus();
                $.ajax( {
                    dataType : 'html',
                    url : './transaction_start',
                    type : 'get',
                    success : function (data) {
                        $('#transaction_id').html(data);
                        var tid = $('#transaction_id').text();
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

    $('#search').keyup(function() {
        var qry = $('#search').val();
        $.ajax( {
            dataType : 'html',
            url : './product_search',
            type : 'GET',
            data : {
                'qry' : $('#search').val(),
            },
            success : function (data) {
            $('#query_result').html(data);
            },
            error : function(xhr, status,error) {
                console.log(xhr.responseText);
            }
        });    
    });
    
    $('#checkout-modal').on('show.bs.modal', function() {
        var tid = $('#transaction_id').text();
        $.ajax( {
            dataType : 'html',
            url : './confirm_order',
            type : 'GET',
            data : {
                'tid' : tid,
            },
            success : function (response) {
            $('#confirm_output').html(response);
            },
            error : function(xhr, status,error) {
                console.log(xhr.responseText);
            }
        });   
    });
    $('#checkout-modal').on('hidden.bs.modal', function() {
        $('#checkout-modal').modal('dispose');
    });

    $('#orderBy').on('shown.bs.modal', function() {
        $('#checkout-modal').modal('hide');
        $('#customer_name').val('');
        $('#customer_name').focus();
    });

    $('#orderBy').on('hidden.bs.modal', function() {
        $('#checkout-modal').modal('show');
    });

    $('#make_order').click(function() {
        var tid = $('#transaction_id').text();
        var cname = $('#customer_name').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax( {
            dataType : 'html',
            url : './make_order',
            type : 'POST',
            data : {
                'tid' : tid,
                'cname' : cname,
            },
            success : function (response) {
            $('#order_success').modal('show');
            },
            error : function(xhr, status,error) {
                console.log(xhr.responseText);
            }
        }); 
    });

    $('#order_success').on('shown.bs.modal', function() {
        $('#orderBy').modal('hide');
        $('#orderBy').on('hidden.bs.modal', function() {
            $('#checkout-modal').modal('dispose');
        });
        $('#finish_order').click(function() {
            $(location).attr('href', './homepage');
        });
    });

    $('#save_order').click(function() {
        var tid = $('#transaction_id').text();
        var cname = $('#customer_name_confirm').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax( {
            dataType : 'html',
            url : './save_transaction',
            type : 'POST',
            data : {
                'tid' : tid,
                'cname' : cname,
            },
            success : function (response) {
            $('#order_success_confirm').modal('show');
            $('#save_transaction').modal('hide');
            },
            error : function(xhr, status,error) {
                console.log(xhr.responseText);
            }
        }); 
    });

});

$('#order_success_confirm').on('shown.bs.modal', function() {
    $('#finish_save_order').click(function() {
            $(location).attr('href', './homepage');
        });
});


//Keycodes on alternate cashier_system
// $(document).keyup(function(event) {
//     if(event.keyCode === 13) {
//         if($('#price_to_pay').text() === "" || $('#price_to_pay').text() === "NaN") {
            
//         }else{
//             var tid = $('#transaction_id').text();
//             var cname = "Success";
//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             });
//             $.ajax( {
//                 dataType : 'html',
//                 url : './make_order',
//                 type : 'POST',
//                 data : {
//                     'tid' : tid,
//                     'cname' : cname,
//                 },
//                 success : function (response) {
//                     $('#order_success').modal('show');
//                 },
//                 error : function(xhr, status,error) {
//                     console.log(xhr.responseText);
//                 }
//             });
//         }
//     }
// });

$('#order_success').keyup('shown.bs.modal', function(event) {
    if(event.keyCode === 13) {
        $(location).attr('href', './homepage');
    }
});
//Keycodes on alternate cashier_system

</script>