<!-- Modal -->
<div class="modal fade" id="edit-product-{{$get->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="./product/{{$get->id}}/edit" method="POST">
                {{csrf_field()}}
                <input type="text" name="product_name" class="form-control mb-1" placeholder="Product Name" value="{{$get->product_name}}">
                <select class="form-control mb-1" name="category">
                    @foreach($getCategory as $cat)
                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                </select>
                <input type="number" name="price" class="form-control mb-1" placeholder="Price" value="{{$get->price}}">
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#orderBy">Edit</button>
        </div>
        </form>
        </div>
    </div>
</div>