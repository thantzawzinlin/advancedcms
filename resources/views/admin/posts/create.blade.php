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
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" cols="30" rows="10" value="{{isset($post)? $post->content:''}}"class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="published At">published At</label>
                    <input type="text" name="published_at" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >{{ isset($post)?'Edit Post':'Create Post' }}</button>
                </div>       
            
            </form>
        </div>
    </div>
@stop