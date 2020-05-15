@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <h2>
                    My Keto Kart <i class="fas fa-shopping-cart"></i></h2>
                <div class="card">
                    <div class="list-group">
                        @foreach ($items as $index => $item)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        @if($item->associatedModel != null)
                                        <img class="img-thumbnail" height="150px" style="max-height: 150px" src="{{ $item->associatedModel->thumbnail }}">
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <h4>{{$item->name}}</h4>
                                        @if($item->associatedModel != null)
                                            <p>{{$item->associatedModel->description}}</p>
                                        @endif
                                        <h5>Qty {{$item->quantity}} &times; Price ${{number_format($item->price, 2, '.', ',')}} = ${{ number_format(($item->quantity * $item->price), 2, '.', ',') }}</h5>

                                        <div class="btn-toolbar">
                                            <div class="btn-group mr-3">
                                                <a class="btn btn-success btn-sm" href="#">
                                                    <i class="fas fa-plus"></i>
                                                    Qty
                                                </a>
                                                <a class="btn btn-warning btn-sm" href="#">
                                                    <i class="fas fa-minus"></i>
                                                    Qty
                                                </a>
                                            </div>

                                            <div class="btn-group">
                                                <a class="btn btn-danger btn-sm" href="#">
                                                    <i class="fas fa-trash"></i>
                                                    Remove Item
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-center mb-2">
                        <h6>
                            Subtotal: ${{ number_format(\Cart::session(Auth::user()->id)->getSubTotal(), 2, '.', ',' ) }}
                        </h6>
                        <p>
                            VAT 12%: ${{ number_format(
                                \Cart::session(Auth::user()->id)
                                ->getCondition('VAT 12%')
                                ->getCalculatedValue(\Cart::session(Auth::user()->id)->getSubTotal()), 2, '.', ','
                                )}}
                        </p>
                        <h4>
                            Total: ${{ number_format(\Cart::session(Auth::user()->id)->getTotal(), 2, '.', ',' ) }}
                        </h4>
                    </div>
                    <a href="#" class="btn btn-primary btn-block btn-large">Let's Checkout</a>
                    <a href="#" class="btn btn-secondary btn-block btn-large">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
@endsection

