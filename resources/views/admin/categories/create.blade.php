@extends('layouts.app')

@section('content')
     <div class="d-flex justify-content-end">
        <a href="{{ route('categories.index') }}" class="btn btn-outline-success mb-2">Back</a>
    </div>
    <div class="card card-primary">
        <div class="card-header">
            Category
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success" >Create Category</button>
                </div>       
            
            </form>
        </div>
    </div>
@stop