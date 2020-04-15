@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-end">
      <a href="{{ route('categories.create') }}" class="btn btn-outline-success mb-2">Create Category</a>
  </div>
  
    <div class="card card-default">
        <div class="card-header">
            Category
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>Name</th>
                    <th>post count</th>
                    <th>Edit</th>
                    <th>delete</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->posts->count() }}</td>
                            <td><a href="{{ route('categories.edit',$category->id) }}" class="btn btn-warning text-primary">Edit</a></td>
                            <td><button type="button" onclick="handleDelete({{ $category->id }})" 
                                class="btn btn-danger " 
                                >Delete</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                                <!-- Modal -->
                       <form action="" method="POST" id="formDelete">
                           @csrf
                           @method('DELETE')
                                <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger">Are you sure you want to delete this category?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                       </form>
        </div>
    </div>

@stop
@section('scripts')

       
        <script>
            function handleDelete(id){
               
                
                var form =document.getElementById('formDelete')
                form.action='/admin/categories/' + id //do not forget to pass the full Path .here i had to add "/admin/categories/" because  in my route i had added ["prefix" = "admin"]
                $('#DeleteModal').modal('show')
            }
         
        </script>
@stop