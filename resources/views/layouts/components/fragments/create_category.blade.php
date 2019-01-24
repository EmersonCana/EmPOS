
    <div class="card">
        <div class="card-body">
            <form action="./create_category_validate" method="post">
                {{csrf_field()}}
                <input type="text" name="category_name" class="form-control" placeholder="Input category name">
                <div class="text-right">
                    <button type="submit" class="btn btn-success mt-2">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header text-dark">
            All Categories
        </div>
        <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getCategory as $cat)
                        <tr>
                        <th scope="row">{{$cat->id}}</th>
                        <td>{{$cat->category_name}}</td>
                        <td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-category-{{$cat->id}}">Edit</a>&nbsp;<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-category-{{$cat->id}}">Delete</a></td>
                        </tr>
                        <tr>
                            @include('layouts.components.modals.admin_edit_category_modal')
                            @include('layouts.components.modals.admin_delete_category_modal')
                        @endforeach 
                    </tbody>
                </table>
        </div>
    </div>