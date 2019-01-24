
    <div class="card">
        <div class="card-header bg-primary text-light">
            Create Product
        </div>
        <div class="card-body">
            <form action="./create_product" method="POST">
            {{csrf_field()}}
                <input type="text" name="product_name" class="form-control mb-1" placeholder="Product Name">
                <select class="form-control mb-1" name="category">
                    @foreach($getCategory as $cat)
                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
                <select name="product_key" class="form-control mb-1" aria-placeholder="Product Key">
                    <option>Product Key</option>
                    @php
                        $i = 0;
                    @endphp
                    @for($i = 0; $i <= 30; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
                <input type="number" name="price" class="form-control mb-1" placeholder="Price">
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">Product Key</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getProducts as $get)
                        <tr>
                        <th scope="row">{{$get->product_key}}</th>
                        <td>{{$get->product_name}}</td>
                        <td>{{$getCategory->find($get->category_id)->category_name}}</td>
                        <td>₱{{$get->price}}</td>
                        <td><a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-product-{{$get->id}}">Edit</a>&nbsp;<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-product-{{$get->id}}">Delete</a></td>
                        </tr>
                        @include('layouts.components.modals.admin_edit_product_modal')
                        @include('layouts.components.modals.admin_delete_product_modal')
                        @endforeach
                    </tbody>
                </table>


