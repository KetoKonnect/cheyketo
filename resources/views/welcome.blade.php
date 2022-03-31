@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand active" href="#">Showing: <b>
  @if(Route::currentRouteName() == 'storeCategoryPage')    
  {{ Route::input('category')->name }} Products
  @else
  All Products
  @endif
</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#storeControllBar" aria-controls="storeControllBar" aria-expanded="false" aria-label="Toggle store controlls">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="storeControllBar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item {{ (Route::currentRouteName() == 'storefront') ? 'active' : '' }}" href="{{ route('storefront') }}">Show All Products</a>
          <div class="dropdown-divider"></div>
          @foreach ($categories as $category)
          <a class="dropdown-item {{ (Route::currentRouteName() == 'storeCategoryPage') &&(Route::input('category', )->id == $category->id) ? 'active' : '' }}" href="{{ route('storeCategoryPage', $category) }}">{{ $category->name }}</a>
          @endforeach
        </div>
      </li>
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>

    <div class="row">
        <div class="col-lg-12">

            <div class="row">

                @if($products->count() > 0)
                @foreach($availableProducts as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset($product->thumbnail) }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">{{ $product->name }}</a>
                            </h4>
                            <h5>${{number_format($product->price, 2, '.',',')}}</h5>
                            <p class="card-text">{{$product->description }}</p>
                        </div>
                        @if($product->status == 'available' && $product->qty > 0)
                        <div class="card-footer">
                            <form method="POST" action="{{ route('cart.add', $product->id)}}">
                                @csrf
                                <button type="submit" class="btn-primary btn-block">Add to cart</button>
                            </form>
                        </div>
                        @else
                        <div class="card-footer">
                            <p>Currently unavailable at this time.</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

                @foreach($unavailableProducts as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset($product->thumbnail) }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">{{ $product->name }}</a>
                            </h4>
                            <h5>${{number_format($product->price, 2, '.',',')}}</h5>
                            <p class="card-text">{{$product->description }}</p>
                        </div>
                        @if($product->status == 'available' && $product->qty > 0)
                        <div class="card-footer">
                            <form method="POST" action="{{ route('cart.add', $product->id)}}">
                                @csrf
                                <button type="submit" class="btn-primary btn-block">Add to cart</button>
                            </form>
                        </div>
                        @else
                        <div class="card-footer">
                            <p>Currently unavailable at this time.</p>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-center">
                    <h3>Restocking the shelves, stay tuned <i class="fas fa-heart"></i> </h3>
                </div>
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
