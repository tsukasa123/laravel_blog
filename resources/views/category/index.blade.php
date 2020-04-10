@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-primary text-light">All Categories</div>

        <div class="card-body">
            @if ($categories->count() > 0)
                
            <table class="table table-hover">
                <thead>
                    <th>Name</th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody>

                    @foreach($categories as $category)
                        <tr>
                            <td>
                                {{$category->name}}
                            </td>
                            <td>
                                <a href="{{ route('category.edit', [$category->id]) }}" class="btn btn-sm btn-success">Edit</a>
                            </td>

                            <td>
                                <form action="{{ route('category.destroy', [$category->id]) }}" method="POST">
                                    @csrf
                                    {{-- Form method spoofing --}}
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else

                <strong class="text-center">No posts found yet</strong>

            @endif
        </div>
    </div>

@endsection
