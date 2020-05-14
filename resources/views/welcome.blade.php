@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">
          <div class="col-lg-12">

            <div class="row">

                @if($products->count() > 0)
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
                      <form method="POST" action="{{ route('cart.add', $product->id)}}">
                              @csrf
                              <button type="submit" class="btn-primary btn-block">Add to cart</button>
                          </form>
                      </div>
                    </div>
                  </div>
                @endforeach
                @else
                <h3>Restocking the shelves, stay tuned <i class="fas fa-heart"></i> </h3>
                @endif


            </div>
            <!-- /.row -->

          </div>
          <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

      </div>
      <!-- /.container -->
@endsection
