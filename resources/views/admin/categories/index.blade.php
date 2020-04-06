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
                    <th>Edit</th>
                    <th>delete</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td><a href="{{ route('categories.edit',$category->id) }}" class="btn btn-warning text-primary">Edit</a></td>
                            <td>Delete</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop