@if($search_result->count() > 0)
<table class="table table-hover">
    <thead>
        <tr>
        <th scope="col">Product Name</th>
        <th scope="col">Category</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($search_result as $product)
        <tr>
            <td>{{$product->product_name}}</td>
            <td>
            @php
                echo $getCategoryName->find($product->category_id)->category_name;
            @endphp
            </td>
            <td>₱{{$product->price}}</td>
            <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong_{{$product->id}}">
                        Add to Cart
                    </button>
                
            </td>
            @include('layouts.components.modals.cashier_quantity_modal')
        </tr>
        
        @endforeach
    </tbody>
</table>
@endif