@extends('layouts.app')

@section('content')
   @include('includes.errors')
     <div class="d-flex justify-content-end">
        <a href="{{ route('posts.index') }}" class="btn btn-outline-success mb-2">Back</a>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            {{ isset($post) ? 'Edit Post' : 'Create Post'}}
        
        </div>
        <div class="card-body">
            <form action="{{ isset($post)? route('posts.update',$post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{isset($post)? $post->title:''}}"class="form-control">
                </div>
                 @if(isset($post))
                   <img src="{{ asset('/storage/' .$post->image) }}" width='100px'>
                 @endif
                <div class="form-group">                   
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                    
                </div>
                 <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                            @if(isset($post))
                                    @if($post->category->id==$category->id)   
                                        selected 
                                    @endif
                            @endif
                            >{{ $category->name }}</option>
                        @endforeach
                        
                    </select>
                   
                </div>
                @if($tags->count()>0)
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select name="tags[]" id="tags" class=" tags-selector form-control" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}"
                                @if(isset($post))

                                    @if($post->hasTags($tag->id))
                                        selected
                                    @endif    
                                @endif
                                
                                >{{ $tag->tags_name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" value="{{ isset($post)? $post->content:'' }}" >
                    <trix-editor input="content"></trix-editor>
                </div>
                <div class="form-group">
                    <label for="published At">published At</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{ isset($post)?$post->published_at:'' }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >{{ isset($post)?'Edit Post':'Create Post' }}</button>
                </div>       
            
            </form>
        </div>
    </div>
@stop
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@stop

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
    flatpickr("#published_at",{
       enableTime: true,
    });
    $(document).ready(function() {
    $('.tags-selector').select2();
    });
    </script>

@stop