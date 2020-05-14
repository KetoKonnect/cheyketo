@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">
          <div class="col-lg-12">

            <div class="row">

                @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="{{ $product->thumbnail }}" alt=""></a>
                      <div class="card-body">
                        <h4 class="card-title">
                        <a href="#">{{ $product->name }}</a>
                        </h4>
                        <h5>${{$product->price}}</h5>
                        <p class="card-text">{{$product->description }}</p>
                      </div>
                      <div class="card-footer">
                          <button class="btn-primary btn-block" >Add to cart</button>
                      </div>
                    </div>
                  </div>
                @endforeach

            </div>
            <!-- /.row -->

          </div>
          <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->
@endsection
