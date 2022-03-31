@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Category | {{ $category->name }} | {{ $category->products->count() }} products</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <h4>Description</h4>
            @if ($category->description != null)
            <p>{{ $category->description }}</p>
            @else
            <p>No Description available</p>
            @endif
        </div>
        <div class="col-md-6">
            <h4>Products</h4>
            @if ($category->products->count() > 0)
        <ul class="list-group">
                    @foreach ($category->products as $item)
                        <li class="list-group-item d-flex w-100 ">
                        <img class="img-thumbnail mr-2" src="{{ asset(App\Product::withTrashed()->find($item->id)->thumbnail) }}" style="max-width: 100px;">
                            <div>
                                <h5>{{ $item->name }}</h5>
                                {{ $item->description }} <br>
                                Qty {{ $item->qty }} &times; ${{ $item->price }} = ${{ number_format(($item->qty * $item->price), 2, '.', ',') }}
                            </div>
                        </li>
                    @endforeach
                </ul>
                @else
                <p>There are no products in this category. <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-primary">Edit Category</a></p>
                @endif
        </div> 
    </div>
</div>
@endsection
