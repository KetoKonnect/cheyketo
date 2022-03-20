@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <h1>Create a Category</h1>
        <hr>
        <form action="{!! route('admin.category.store') !!}" method="post">
            @csrf
            <label for="name" class="label">
                Category Name
            </label>
            <input type="text" class="form-control" />

            
        </form>
    </div>
</div>
@endsection