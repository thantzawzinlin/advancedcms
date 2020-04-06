@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-end">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-success mb-2">Back</a>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            {{ isset($category) ? 'Edit Category' : 'Create Category'}}
        
        </div>
        <div class="card-body">
            <form action="{{ isset($category)? route('categories.update',$category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{isset($category)? $category->name:''}}"class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >{{ isset($category)?'Edit Category':'Create Category' }}</button>
                </div>       
            
            </form>
        </div>
    </div>
@stop