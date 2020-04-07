@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-end">
      <a href="{{ route('posts.create') }}" class="btn btn-outline-success mb-2">Create Post</a>
  </div>
  
    <div class="card card-default">
        <div class="card-header">
            Post
        </div>
        <div class="card-body">
            @if($posts->count()>0)
            <table class="table table-hover">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                   
                    <th>Edit</th>
                  
                    <th>delete</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><img src="{{asset('storage/'.$post->image)}}" alt="{{ $post->title }}" width="100px",height="100px"></td>
                            <td>{{ $post->title }}</td>
                            @if(!$post->trashed())
                            <td><a href="{{ route('posts.edit',$post->id) }}" class="btn btn-warning text-primary">Edit</a></td>
                            @endif
                            <td><button type="button" onclick="handleDelete({{ $post->id }})" 
                                class="btn btn-danger " 
                                >{{ $post->trashed()?'Delete':'Trash' }}</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else 

             <div class="alert alert-warning">
                 <p class="text-primary">
                     You Have no post for now
                 </p>
             </div>
             @endif
                                <!-- Modal -->
                       <form action="" method="POST" id="formDelete">
                           @csrf
                           @method('DELETE')
                                <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Delete Post</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger">Are you sure you want to delete this Post?</p>
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
                form.action='/admin/posts/' + id //do not forget to pass the full Path .here i had to add "/admin/categories/" because  in my route i had added ["prefix" = "admin"]
                $('#DeleteModal').modal('show')
            }
         
        </script>
@stop