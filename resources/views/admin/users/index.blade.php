@extends('layouts.app')

@section('content')
 
  
    <div class="card card-default">
        <div class="card-header">
            User
        </div>
        <div class="card-body">
            @if($users->count()>0)
            <table class="table table-hover">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                   
                    <th>Email</th>
                  
                    <th>permission</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td><img src="{{ Gravatar::src('thantzaw@gmail.com', 40) }}"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                             @if(!$user->IsAdmin()) 
                                <form action="{{ route('make_admin',$user->id) }}" method="POST">
                                    @csrf
                                    <input class="form-control btn btn-success"  type="submit" value="Make Admin">                                
                                </form>
                            
                            
                            @endif 
                             </td>
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
                               
                       
        </div>
    </div>

@stop
