@extends('layouts.admin')

@section('content')
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Products</li>
            </ol>
          </nav>


        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <h2>All Products</h2>
                        <a href="{{ route('admin.product.create')}}" class="btn btn-outline-secondary">Add a Product</a>
                        <div class="table-responsive mt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Qty Avail.</th>
                                        <th scope="col">Date created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->description}}</td>
                                            <td>{{$product->qty}}</td>
                                            <td>{{$product->created_at->toFormattedDateString()}}</td>
                                            <td>
                                                <a href="{{route('admin.viewProduct', $product->id)}}" class="btn btn-outline-secondary">
                                                    view
                                                </a>
                                                <button class="btn btn-outline-danger" onclick="delete_product({{$product->id}})">Delete</button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
    function delete_product(id) {
        Swal.fire({
            title: 'Please confirm',
            text: 'Do you really want to delete?',
            icon: 'warning',
            confirmButtonText: 'Yes, Delete.'
        }).then((result) => {

        })
    }
    </script>
@endsection
