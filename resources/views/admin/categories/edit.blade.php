@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Category | {{ $category->name }} | {{ $category->products->count() }} products</h2>
    <form method="POST" action="{{ route('admin.category.destroy', $category) }}">
        @csrf
        <button type="submit" class="btn btn-danger">Delete This Category</button>
    </form>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <p>Change the category name and description</p>
            {!! Form::model($category, ['route' => ['admin.category.update', $category->id]]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Description') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description
                (optional)']) !!}
            </div>

            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col overflow-auto">
                    <h4>{{ $category->name }} Products</h4>
                    <hr />
                    @if ($category->products->count() > 0)
                    <ul>
                        @foreach ($category->products as $product)
                        <li>
                            {!! form::open(['route' => ['admin.category.removeProduct', $category->id, $product->id]]) !!}
                            @method('PATCH')
                            {!! form::submit('Remove', ['class' => 'btn btn-link']) !!}
                            {{ $product->name }}
                            {!! form::close() !!}
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>There are no products in this category, add some from the list below</p>
                    @endif
                </div>

            </div>

            <div class="row">
                <div class="col overflow-auto">
                    <h4>Unclassifid Products</h4>
                    <hr>
                    @if ($unclassifiedProducts->count() > 0)
                    <ul>
                        @foreach ($unclassifiedProducts as $product)
                        <li>
                            {!! form::open(['route' => ['admin.category.addProduct', $category->id, $product->id]]) !!}
                            @method('PATCH')
                            {!! form::submit('Add', ['class' => 'btn btn-link']) !!}
                            {{ $product->name }}
                            {!! form::close() !!}
                        </li>
                        @endforeach
                    </ul>
                    @else 
                    <p>There are no un-classified products</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
