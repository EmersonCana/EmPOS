<script>
$(document).ready(function() {
    $('#datepicker').change(function() {
        var date = $('#datepicker').val();
        $.ajax( {
            dataType : 'html',
            url : './daily_sales_data',
            type : 'get',
            data : {
                'date' : date,
            },
            success : function (response) {
            $('#daily_sales_data').html(response);
            console.log('?');
            },
            error : function(xhr, status,error) {
                console.log(xhr.responseText);
            }
        }); 
    });
});


</script>