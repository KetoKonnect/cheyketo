@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
        <h1>Create a Category</h1>
        <hr>
        <form action="{!! route('admin.category.store') !!}" method="post">
            @csrf
            <div class="form-group">
            <label for="category_name" class="label">
                Category Name
            </label>
            <input type="text" class="form-control" name="category_name" id="category_name" required />
            </div>

            <div class="form-group">
                <label for="category_description" class="label">
                    Category Description
                </label>
                <textarea class="form-control" name="category_description" id="category_description" placeholder="Description (Optional)"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        </div>
        
    </div>
</div>
@endsection