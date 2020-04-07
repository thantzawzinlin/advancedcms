@extends('layouts.app')

@section('content')
   @include('includes.errors')
     <div class="d-flex justify-content-end">
        <a href="{{ route('tags.index') }}" class="btn btn-outline-success mb-2">Back</a>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            {{ isset($tag) ? 'Edit tags' : 'Create tags'}}
        
        </div>
        <div class="card-body">
            <form action="{{ isset($tag)? route('tags.update',$tag->id) : route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="tags_name" value="{{isset($tag)? $tag->tags_name:''}}"class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >{{ isset($tag)?'Edit tags':'Create tags' }}</button>
                </div>       
            
            </form>
        </div>
    </div>
@stop