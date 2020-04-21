@extends('layouts.app')
@section('content')

    

        <div class="card">
            <div class="card-header">Create New User</div>

            <div class="card-body">
                 {{-- @include('admin.inc.error') --}}
                @if(count($errors) >0)
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
           
                <form action="{{route('user.store')}}" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control">    
                    </div> 
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control">    
                    </div>                    
                    <div class="form-group">
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">Add User</button>
                        </div>
                    </div>
                </form>
            </div>   
    </div>





@endsection