
<!-- Modal -->
<div class="modal fade" id="edit-category-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="./category/{{$cat->id}}/edit" method="post">
                {{csrf_field()}}
                <input type="text" name="category_name" class="form-control" placeholder="Input category name" value="{{$cat->category_name}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#orderBy">Edit</button>
            </div>
            </form>
            </div>
        </div>
    </div>