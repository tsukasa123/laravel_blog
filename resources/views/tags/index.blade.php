@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header bg-primary text-light">All Tags</div>

        <div class="card-body">
            @if ($tags->count() > 0)
                
            <table class="table table-hover">
                <thead>
                    <th>Tag Name</th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody>

                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{$tag->tag}}
                            </td>
                            <td>
                                <a href="{{ route('tag.edit', [$tag->id]) }}" class="btn btn-sm btn-success">Edit</a>
                            </td>

                            <td>
                                <form action="{{ route('tag.destroy', [$tag->id]) }}" method="POST">
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
