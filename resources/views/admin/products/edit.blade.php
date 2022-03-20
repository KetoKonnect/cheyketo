@extends('layouts.admin')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.allProducts') }}">All Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.viewProduct', $product->id) }}">{{ $product->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit - {{ $product->name}} </li>
            </ol>
          </nav>
        <div class="row">
            <div class="col">

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="card">
                    <div class="card-body">
                        <h4>Edit Product Details</h4>
                        {!! Form::model($product, ['route' => ['admin.product.update', $product->id]]) !!}
                        {{-- <div class="form-group">
                            {!! Form::label('id', 'Product ID') !!}
                            {!! Form::text('id', $product->id, ['class' => 'form-control', 'required' => 'true']) !!}
                        </div> --}}

                        <div class="form-group">
                            {!! Form::label('name', 'Product Name') !!}
                            {!! Form::text('name', $product->name, ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('price', 'Selling Price') !!}
                            {!! Form::number('price', $product->price, ['class' => 'form-control', 'required' => 'true', 'step' => '0.01']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('qty', 'Available Quantity') !!}
                            {!! Form::number('qty', $product->qty, ['class' => 'form-control', 'required' => 'true']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Product Description') !!}
                            {!! Form::textarea('description', $product->description, ['class' => 'form-control', 'required' => 'true', 'rows' => '5']) !!}
                        </div>
                        <img src="{{ asset($product->thumbnail) }}" class="img-thumbnail" width="70">

                        <button class="btn btn-secondary" v-on:click.prevent="edit_image = true" v-if="edit_image == false">Change thumbnail</button>
                        <div class="form-group" v-if="edit_image">
                            {!! Form::label('thumbnail', 'Photo') !!}
                            {!! Form::file('thumbnail', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        </div>
                        <button class="btn btn-secondary" v-if="edit_image" v-on:click.prevent="edit_image = false">Don't change thumbnail</button>
                        {!! Form::submit('Update', ['class' => 'btn btn-primary btn-block'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
