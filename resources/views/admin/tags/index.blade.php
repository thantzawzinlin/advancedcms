@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-end">
      <a href="{{ route('tags.create') }}" class="btn btn-outline-success mb-2">Create Tag</a>
  </div>
  
    <div class="card card-default">
        <div class="card-header">
            Tag
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th>Name</th>
                    <th>posts count</th>
                    <th>Edit</th>
                    <th>delete</th>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->tags_name }}</td>
                            <td>{{ $tag->posts->count() }}</td>
                            <td><a href="{{ route('tags.edit',$tag->id) }}" class="btn btn-warning text-primary">Edit</a></td>
                            <td><button type="button" onclick="handleDelete({{ $tag->id }})" 
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
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger">Are you sure you want to delete this tag?</p>
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
                form.action='/admin/tags/' + id //do not forget to pass the full Path .here i had to add "/admin/tags/" because  in my route i had added ["prefix" = "admin"]
                $('#DeleteModal').modal('show')
            }
         
        </script>
@stop