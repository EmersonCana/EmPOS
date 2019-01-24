
@foreach($getDailySales as $sales)
<tr>
    <th scope="row">{{$sales->order_name}}</th>
    <td>{{$sales->price}}</td>
    <td>{{$sales->created_at->diffForHumans()}}</td>
    <td class="hidden"></td>
</tr>
@endforeach
<tr class="hidden">
<script>
    $('#today-sales').text({{$dailySales}});
</script>
</tr>