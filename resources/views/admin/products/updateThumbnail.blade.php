@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
        {!! Form::model($product, ['route' => ['admin.product.storeThumbnail', $product->id] , 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('thumbnail', 'New Thumbnail File') !!}
                {!! Form::file('thumbnail', ['accept' => 'image/*']) !!}
            </div>
        {!! Form::submit() !!}
        {!! Form::close() !!}
        </div>
    </div>
    
</div>
@endSection