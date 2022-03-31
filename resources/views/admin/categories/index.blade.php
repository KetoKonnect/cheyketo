@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Categories Manager</h1>
            <hr>
            <a href="{!! route('admin.category.create') !!}" class="btn btn-primary">Create a Category</a>

            @if (count($categories) > 0)
            <table class="table m-4">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{!! route('admin.category.show', $category->id) !!}">View</a> | <a href="{!! route('admin.category.edit', $category->id) !!}">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>There are no categories. Please go a head and create as many as you want.</p>
            @endif
        </div>
    </div>
</div>
@endsection