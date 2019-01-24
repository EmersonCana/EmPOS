@foreach($confirmOrder as $confirm)
<tr>
    <th scope="row">{{$confirm->quantity}}</th>
    <td>{{$confirm->order_name}}</td>
    <td>{{$confirm->price}}</td>
</tr>
@endforeach