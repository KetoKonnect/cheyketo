@extends('layouts.admin')

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('admin.allProducts') }}">All Products</a></li>
              <li class="breadcrumb-item active" aria-current="page">Create a Product</li>
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
                        <h4>Create a Product</h4>
                    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data" class="form">
                        <div class="form-group">
                            <label class="label" for="name">Product Name</label>
                            <input class="form-control" name="name" id="name" type="text" required>
                        </div>

                        <div class="form-group">
                            <label class="label" for="price">Selling Price</label>
                            <input class="form-control" name="price" id="price" type="number" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label class="label" for="qty">Available Quantity</label>
                            <input class="form-control" name="qty" id="qty" type="number" required>
                        </div>

                        <div class="form-group">
                            <label class="label" for="description">Product Description</label>
                            <textarea class="form-control" name="description" id="description" required rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="label" for="thumbnail">Photo</label>
                            <input type="file" class="form-control" name="thumbnail" id="thumbnail" accept="image/*" required>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
