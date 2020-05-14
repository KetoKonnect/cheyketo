@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h4>Admin Login</h4>
                    <form class="form" method="POST" action="{{ route('admin.login') }}">
                            <div class="form-group">
                                <label class="label" for="email">
                                    Email Address
                                </label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>

                            <div class="form-group">
                                <label class="label" for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>

                            @csrf
                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
